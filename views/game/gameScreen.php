<?php

if (!isset($_SESSION['player_id'])) {
    header("Location: ?page=signup");
    exit;
}

$stmt = $pdo->prepare("SELECT mob_id FROM PLAYER WHERE player_id = ?");
$stmt->execute([$_SESSION['player_id']]);
if ($stmt->fetchColumn() === null) {
    header("Location: ?page=midGameMobSelect");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_task'])) {
    $assignmentId = (int) $_POST['assignment_id'];

    $stmt = $pdo->prepare("
        SELECT ta.assignment_id, tt.base_reward
        FROM TASK_ASSIGNMENT ta
        JOIN TASK t ON t.task_id = ta.task_id
        JOIN TASK_TYPE tt ON tt.task_type_id = t.task_type_id
        WHERE ta.assignment_id = ? AND ta.player_id = ? AND ta.completed = FALSE
    ");
    $stmt->execute([$assignmentId, $_SESSION['player_id']]);
    $assignment = $stmt->fetch();

    if ($assignment) {
        $pdo->prepare("UPDATE TASK_ASSIGNMENT SET completed = TRUE WHERE assignment_id = ?")
            ->execute([$assignmentId]);

        $pdo->prepare("UPDATE PLAYER SET cash = cash + ?, xp = xp + 20 WHERE player_id = ?")
            ->execute([$assignment['base_reward'], $_SESSION['player_id']]);

        $pdo->prepare("
            UPDATE MOB SET balance = balance + ?
            WHERE mob_id = (SELECT mob_id FROM PLAYER WHERE player_id = ?)
        ")->execute([$assignment['base_reward'], $_SESSION['player_id']]);
    }

    header("Location: ?page=gameScreen");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_territory_vote'])) {
    $territoryId = (int) $_POST['territory_id'];

    $stmt = $pdo->prepare("SELECT mob_id, rank_id FROM PLAYER WHERE player_id = ?");
    $stmt->execute([$_SESSION['player_id']]);
    $me = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT rank_level FROM `RANK` WHERE rank_id = ?");
    $stmt->execute([$me['rank_id']]);
    $myRankLevel = $stmt->fetchColumn();

    if ($myRankLevel >= 2) {
        $stmt = $pdo->prepare("SELECT territory_name, income_per_hour, mob_id FROM TERRITORY WHERE territory_id = ?");
        $stmt->execute([$territoryId]);
        $territory = $stmt->fetch();

        if ($territory['mob_id'] != $me['mob_id']) {
            $stmt = $pdo->prepare("
                SELECT vote_id FROM VOTE
                WHERE mob_id = ? AND target_territory_id = ? AND vote_type = 'Territory Takeover' AND resolved = FALSE
            ");
            $stmt->execute([$me['mob_id'], $territoryId]);
            $existingVote = $stmt->fetch();

            if (!$existingVote) {
                $cost = $territory['income_per_hour'] * 20;

                $stmt = $pdo->prepare("
                    INSERT INTO VOTE (mob_id, vote_type, called_by, target_territory_id, description, cost)
                    VALUES (?, 'Territory Takeover', ?, ?, ?, ?)
                ");
                $stmt->execute([$me['mob_id'], $_SESSION['player_id'], $territoryId, "Take over {$territory['territory_name']}?", $cost]);
            }
        }
    }

    header("Location: ?page=gameScreen");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_perk_vote'])) {
    $taskTypeId = (int) $_POST['task_type_id'];

    $stmt = $pdo->prepare("SELECT mob_id, rank_id FROM PLAYER WHERE player_id = ?");
    $stmt->execute([$_SESSION['player_id']]);
    $me = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT rank_level FROM `RANK` WHERE rank_id = ?");
    $stmt->execute([$me['rank_id']]);
    $myRankLevel = $stmt->fetchColumn();

    if ($myRankLevel >= 2) {
        $stmt = $pdo->prepare("SELECT type_name, unlock_cost FROM TASK_TYPE WHERE task_type_id = ?");
        $stmt->execute([$taskTypeId]);
        $type = $stmt->fetch();

        $stmt = $pdo->prepare("
            INSERT INTO VOTE (mob_id, vote_type, called_by, target_task_type_id, description, cost)
            VALUES (?, 'Perk Unlock', ?, ?, ?, ?)
        ");
        $stmt->execute([$me['mob_id'], $_SESSION['player_id'], $taskTypeId, "Unlock {$type['type_name']} training?", $type['unlock_cost']]);
    }

    header("Location: ?page=gameScreen");
    exit;
}

$stmt = $pdo->prepare('
    SELECT p.username, p.avatar, p.cash, m.mob_name, r.rank_name
    FROM PLAYER p
    LEFT JOIN MOB m ON m.mob_id = p.mob_id
    LEFT JOIN `RANK` r ON r.rank_id = p.rank_id
    WHERE p.player_id = ?');

$stmt->execute([$_SESSION['player_id']]);
$player = $stmt->fetch();

?>

<body class="bg-[url('../public/img/WoodBG.png')] bg-cover bg-center bg-no-repeat min-h-screen overflow-hidden select-none relative">
    <?php include __DIR__ . '/../partials/gameSidebar.php'; ?>
    <?php include __DIR__ . '/../partials/gameMap.php'; ?>

    <a href="?page=logout" class="absolute -bottom-4 rotate-6 -left-4">
        <div class="aspect-425/253 w-fit bg-[url('../public/img/ledgerBG.png')] gap-8 pt-5 pb-8 flex flex-col items-center px-7 bg-cover rounded-lg drop-shadow-2xl/33 hover:scale-105 transition-all duration-150 ease-in-out hover:cursor-pointer">
            <h1 class="font-koho font-bold text-6xl">Log Out</h1>
        </div>
    </a>
</body>