<?php
$stmt = $pdo->prepare("SELECT mob_id, mob_name FROM MOB WHERE mob_id = (SELECT mob_id FROM PLAYER WHERE player_id = ?)");
$stmt->execute([$_SESSION['player_id']]);
$mob = $stmt->fetch();

$ranks = ['Underboss', 'Capo', 'Soldier', 'Associate'];
$groups = [];

foreach ($ranks as $rankName) {
    $stmt = $pdo->prepare("
        SELECT player_id, username, avatar, xp, created_at FROM PLAYER p
        JOIN `RANK` r ON r.rank_id = p.rank_id
        WHERE p.mob_id = ? AND r.rank_name = ?
    ");
    $stmt->execute([$mob['mob_id'], $rankName]);
    $groups[$rankName] = $stmt->fetchAll();
}
?>

<div class="flex flex-col items-center gap-10 lg:gap-20 pt-5 h-screen overflow-y-auto scrollbar-none pb-10">
    <h1 class="font-koho tracking-tight text-white drop-shadow-xl/90 font-bold text-4xl sm:text-5xl md:text-7xl lg:text-8xl xl:text-9xl"><?= htmlspecialchars($mob['mob_name']) ?></h1>

    <?php
    $allMembers = [];
    foreach ($groups as $rankName => $members): ?>
        <?php if (!empty($members)): ?>
            <?php
            $names = array_column($members, 'username');
            $avatars = array_column($members, 'avatar');
            $memberData = $members;
            $allMembers = array_merge($allMembers, $members);
            $position = $rankName === 'Capo' ? 'Capos' : ($rankName === 'Soldier' ? 'Soldiers' : ($rankName === 'Associate' ? 'Associates' : $rankName));
            include __DIR__ . '/../partials/mobPlayerCard.php';
            ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php foreach ($allMembers as $member): ?>
    <input type="checkbox" id="idCard<?= $member['player_id'] ?>" class="hidden">
    <?php include __DIR__ . '/../partials/idCardOverlay.php'; ?>
<?php endforeach; ?>

<style>
    <?php foreach ($allMembers as $member): ?>
    #idCard<?= $member['player_id'] ?>:checked ~ #overlayFor<?= $member['player_id'] ?> {
        display: flex !important;
    }
    <?php endforeach; ?>
</style>