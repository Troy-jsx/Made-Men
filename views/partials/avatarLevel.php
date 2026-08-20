<?php
    if (!isset($_SESSION['player_id'])) {
    header("Location: ?page=signup");
    exit;
}

$stmt = $pdo->prepare("SELECT xp FROM PLAYER WHERE player_id = ?");
$stmt->execute([$_SESSION['player_id']]);
$avatarLevel = $stmt->fetch();
?>

<div class="font-koho font-semibold tracking-koho text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-5xl text-white bg-border-brown drop-shadow-md/90 rounded-full w-fit h-fit pl-2 pr-2.5 py-1 sm:pl-2.5 sm:pr-3 sm:py-1.5 md:pl-3 md:pr-3.5 md:py-1.5 lg:pl-3 lg:pr-3.5 lg:py-1.5 xl:pl-3 xl:pr-4 xl:py-2">
    <h1><?= xpToLevel($avatarLevel['xp'])?></h1>
</div>