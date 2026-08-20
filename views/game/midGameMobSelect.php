<?php
if (!isset($_SESSION['player_id'])) {
    header("Location: ?page=signup");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mob_id'])) {
    $mobId = (int) $_POST['mob_id'];

    $stmt = $pdo->prepare("
        SELECT m.member_cap, COUNT(p.player_id) AS current_count
        FROM MOB m
        LEFT JOIN PLAYER p ON p.mob_id = m.mob_id
        WHERE m.mob_id = ? AND m.eliminated = FALSE
        GROUP BY m.mob_id, m.member_cap
    ");
    $stmt->execute([$mobId]);
    $mobCheck = $stmt->fetch();

    if (!$mobCheck) {
        $errors[] = "That mob doesn't exist.";
    } elseif ($mobCheck['current_count'] >= $mobCheck['member_cap']) {
        $errors[] = "That mob is full.";
    } else {
        $stmt = $pdo->prepare("UPDATE PLAYER SET mob_id = ?, rank_id = 1 WHERE player_id = ?");
        $stmt->execute([$mobId, $_SESSION['player_id']]);

        header("Location: ?page=gameScreen");
        exit;
    }
}
?>

<body class="bg-[url('../public/img/WoodBG.png')] bg-cover bg-center bg-no-repeat min-h-screen overflow-hidden select-none relative">
    <?php include __DIR__ . '/../partials/MobsBarRight.php'; ?>
    <?php include __DIR__ . '/../partials/gameMap.php'; ?>
</body>