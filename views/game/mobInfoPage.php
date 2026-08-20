<?php
if (!isset($_SESSION['player_id'])) {
    header("Location: ?page=signup");
    exit;
}

$stmt = $pdo->prepare("
    SELECT v.vote_id, v.mob_id, v.target_player_id, v.target_territory_id, v.target_task_type_id, v.vote_type, v.cost,
    (SELECT COUNT(*) FROM VOTE_CAST WHERE vote_id = v.vote_id AND vote_value = TRUE) AS yes_count,
    (SELECT COUNT(*) FROM VOTE_CAST WHERE vote_id = v.vote_id AND vote_value = FALSE) AS no_count,
    (SELECT COUNT(*) FROM PLAYER p JOIN `RANK` r ON r.rank_id = p.rank_id WHERE p.mob_id = v.mob_id AND r.rank_name != 'Associate') AS total_eligible
    FROM VOTE v
    WHERE v.mob_id = (SELECT mob_id FROM PLAYER WHERE player_id = ?) AND v.resolved = FALSE
");
$stmt->execute([$_SESSION['player_id']]);
$pendingVotes = $stmt->fetchAll();

foreach ($pendingVotes as $vote) {
    if ($vote['yes_count'] > $vote['total_eligible'] / 2) {
        $mobBalanceStmt = $pdo->prepare("SELECT balance FROM MOB WHERE mob_id = ?");
        $mobBalanceStmt->execute([$vote['mob_id']]);
        $currentBalance = $mobBalanceStmt->fetchColumn();

        $canAfford = ($vote['cost'] === null) || ($currentBalance >= $vote['cost']);

        if ($canAfford) {
            if ($vote['vote_type'] === 'Promotion') {
                $stmt2 = $pdo->prepare("
                    UPDATE PLAYER SET rank_id = (
                        SELECT rank_id FROM `RANK` WHERE rank_level = (
                            SELECT rank_level + 1 FROM `RANK` WHERE rank_id = (SELECT rank_id FROM PLAYER WHERE player_id = ?)
                        )
                    )
                    WHERE player_id = ?
                ");
                $stmt2->execute([$vote['target_player_id'], $vote['target_player_id']]);
            } elseif ($vote['vote_type'] === 'Territory Takeover') {
                $pdo->prepare("UPDATE MOB SET balance = balance - ? WHERE mob_id = ?")
                    ->execute([$vote['cost'], $vote['mob_id']]);
                $pdo->prepare("UPDATE TERRITORY SET mob_id = ? WHERE territory_id = ?")
                    ->execute([$vote['mob_id'], $vote['target_territory_id']]);
            } elseif ($vote['vote_type'] === 'Perk Unlock') {
                $pdo->prepare("UPDATE MOB SET balance = balance - ? WHERE mob_id = ?")
                    ->execute([$vote['cost'], $vote['mob_id']]);
                $pdo->prepare("INSERT IGNORE INTO MOB_UNLOCKED_TASK_TYPE (mob_id, task_type_id) VALUES (?, ?)")
                    ->execute([$vote['mob_id'], $vote['target_task_type_id']]);
            }

            $pdo->prepare("UPDATE VOTE SET resolved = TRUE, passed = TRUE WHERE vote_id = ?")->execute([$vote['vote_id']]);
        }
    } elseif ($vote['no_count'] > $vote['total_eligible'] / 2) {
        $pdo->prepare("UPDATE VOTE SET resolved = TRUE, passed = FALSE WHERE vote_id = ?")->execute([$vote['vote_id']]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_promotion_vote'])) {
    $targetPlayerId = (int) $_POST['target_player_id'];

    $stmt = $pdo->prepare("SELECT mob_id, rank_id FROM PLAYER WHERE player_id = ?");
    $stmt->execute([$_SESSION['player_id']]);
    $me = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT r.rank_id, r.rank_name FROM PLAYER p JOIN `RANK` r ON r.rank_id = p.rank_id WHERE p.player_id = ?");
    $stmt->execute([$targetPlayerId]);
    $target = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT rank_level FROM `RANK` WHERE rank_id = ?");
    $stmt->execute([$target['rank_id']]);
    $targetLevel = $stmt->fetchColumn();

    $stmt = $pdo->prepare("SELECT rank_name FROM `RANK` WHERE rank_level = ?");
    $stmt->execute([$targetLevel + 1]);
    $nextRankName = $stmt->fetchColumn();

    if ($nextRankName) {
        $stmt = $pdo->prepare("
            INSERT INTO VOTE (mob_id, vote_type, called_by, target_player_id, description)
            VALUES (?, 'Promotion', ?, ?, ?)
        ");
        $stmt->execute([$me['mob_id'], $_SESSION['player_id'], $targetPlayerId, "Promote to {$nextRankName}?"]);
    }

    header("Location: ?page=mobInfo");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cast_vote'])) {
    $voteId = (int) $_POST['vote_id'];
    $voteValue = $_POST['cast_vote'] === 'yes' ? 1 : 0;

    $stmt = $pdo->prepare("SELECT cast_id FROM VOTE_CAST WHERE vote_id = ? AND player_id = ?");
    $stmt->execute([$voteId, $_SESSION['player_id']]);
    if (!$stmt->fetch()) {
        $pdo->prepare("INSERT INTO VOTE_CAST (vote_id, player_id, vote_value) VALUES (?, ?, ?)")
            ->execute([$voteId, $_SESSION['player_id'], $voteValue]);
    }

    $stmt = $pdo->prepare("SELECT mob_id, target_player_id, target_territory_id, target_task_type_id, vote_type, cost FROM VOTE WHERE vote_id = ?");
    $stmt->execute([$voteId]);
    $vote = $stmt->fetch();

    $eligibleVoters = $pdo->prepare("
        SELECT COUNT(*) FROM PLAYER p JOIN `RANK` r ON r.rank_id = p.rank_id
        WHERE p.mob_id = ? AND r.rank_name != 'Associate'
    ");
    $eligibleVoters->execute([$vote['mob_id']]);
    $totalEligible = $eligibleVoters->fetchColumn();

    $yesCount = $pdo->prepare("SELECT COUNT(*) FROM VOTE_CAST WHERE vote_id = ? AND vote_value = TRUE");
    $yesCount->execute([$voteId]);
    $yes = $yesCount->fetchColumn();

    $noCount = $pdo->prepare("SELECT COUNT(*) FROM VOTE_CAST WHERE vote_id = ? AND vote_value = FALSE");
    $noCount->execute([$voteId]);
    $no = $noCount->fetchColumn();

    if ($yes > $totalEligible / 2) {
        $mobBalance = $pdo->prepare("SELECT balance FROM MOB WHERE mob_id = ?");
        $mobBalance->execute([$vote['mob_id']]);
        $currentBalance = $mobBalance->fetchColumn();

        $canAfford = ($vote['cost'] === null) || ($currentBalance >= $vote['cost']);

        if ($canAfford) {
            if ($vote['vote_type'] === 'Promotion') {
                $stmt = $pdo->prepare("
                    UPDATE PLAYER SET rank_id = (
                        SELECT rank_id FROM `RANK` WHERE rank_level = (
                            SELECT rank_level + 1 FROM `RANK` WHERE rank_id = (SELECT rank_id FROM PLAYER WHERE player_id = ?)
                        )
                    )
                    WHERE player_id = ?
                ");
                $stmt->execute([$vote['target_player_id'], $vote['target_player_id']]);
            } elseif ($vote['vote_type'] === 'Territory Takeover') {
                $pdo->prepare("UPDATE MOB SET balance = balance - ? WHERE mob_id = ?")
                    ->execute([$vote['cost'], $vote['mob_id']]);
                $pdo->prepare("UPDATE TERRITORY SET mob_id = ? WHERE territory_id = ?")
                    ->execute([$vote['mob_id'], $vote['target_territory_id']]);
            } elseif ($vote['vote_type'] === 'Perk Unlock') {
                $pdo->prepare("UPDATE MOB SET balance = balance - ? WHERE mob_id = ?")
                    ->execute([$vote['cost'], $vote['mob_id']]);
                $pdo->prepare("INSERT IGNORE INTO MOB_UNLOCKED_TASK_TYPE (mob_id, task_type_id) VALUES (?, ?)")
                    ->execute([$vote['mob_id'], $vote['target_task_type_id']]);
            }

            $pdo->prepare("UPDATE VOTE SET resolved = TRUE, passed = TRUE WHERE vote_id = ?")->execute([$voteId]);
        }
    } elseif ($no > $totalEligible / 2) {
        $pdo->prepare("UPDATE VOTE SET resolved = TRUE, passed = FALSE WHERE vote_id = ?")->execute([$voteId]);
    }

    header("Location: ?page=mobInfo");
    exit;
}

$stmt = $pdo->prepare("SELECT balance FROM MOB WHERE mob_id = (SELECT mob_id FROM PLAYER WHERE player_id = ?)");
$stmt->execute([$_SESSION['player_id']]);
$mobBalance = $stmt->fetchColumn();
?>

<body class="bg-[url('../public/img/WoodBG.png')] bg-cover bg-center bg-no-repeat min-h-screen overflow-hidden select-none relative">
    <?php include __DIR__ . '/../partials/mobInfoBar.php'; ?>

    <div class="absolute top-0 right-0 w-[65vw] h-screen">
        <?php include __DIR__ . '/../partials/MobMembers.php'; ?>
    </div>

    <a href="?page=ledger" class="absolute -bottom-4 rotate-6 -left-4">
        <div class="aspect-425/253 w-fit bg-[url('../public/img/ledgerBG.png')] gap-8 pt-5 pb-8 flex flex-col items-center px-7 bg-cover rounded-lg drop-shadow-2xl/33 hover:scale-105 transition-all duration-150 ease-in-out hover:cursor-pointer">
            <h1 class="font-koho font-bold text-6xl">Open Ledger</h1>
            <h1 class="text-koho text-money-green font-bold tracking-koho text-7xl">$<?= (int)$mobBalance ?></h1>
        </div>
    </a>

    <a href="?page=gameScreen" class="absolute top-4 right-4">
        <button type="button" class='px-3 py-1 sm:text-2xl sm:px-4 sm:py-1 md:text-4xl md:px-6 md:py-1.5 lg:text-6xl lg:py-2 transition-all duration-150 ease-in-out hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg'>
            Back
        </button>
    </a>
</body>