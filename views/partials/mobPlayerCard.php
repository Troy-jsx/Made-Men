<?php
/** @var array $names */
/** @var array $avatars */
/** @var array $memberData */
/** @var string $position */
?>

<div class="relative aspect-690/175 w-[60%] bg-[url('../public/img/cardPaperBG.png')] drop-shadow-xl/80 bg-cover bg-no-repeat">
    <h1 class="absolute top-[-5vh] left-0 translate-x-[2.5vw] font-koho font-bold tracking-koho text-white text-2xl sm:text-3xl md:text-4xl lg:text-4xl xl:text-5xl drop-shadow-lg/80 whitespace-nowrap">
        <?= htmlspecialchars($position) ?>
    </h1>

    <?php
    $stmt = $pdo->prepare("SELECT rank_level FROM `RANK` WHERE rank_id = (SELECT rank_id FROM PLAYER WHERE player_id = ?)");
    $stmt->execute([$_SESSION['player_id']]);
    $myRankLevel = $stmt->fetchColumn();
    ?>

    <?php if (count($names) === 1): ?>
        <div class="flex items-center justify-between h-full px-16">
            <?php $member = $memberData[0]; ?>
            <label for="idCard<?= $member['player_id'] ?>" class="group relative w-[20%] aspect-square cursor-pointer">
                <?php $img = $avatars[0] ?? 'oldDude.png';
                include __DIR__ . '/../partials/avatarImage.php'; ?>
                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1 rounded-md bg-black/85 text-white text-sm font-koho whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-150 pointer-events-none z-50">
                    <?= htmlspecialchars($names[0]) ?>
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-black/85"></div>
                </div>
            </label>

            <?php
            $stmt = $pdo->prepare("SELECT rank_level FROM `RANK` WHERE rank_id = (SELECT rank_id FROM PLAYER WHERE player_id = ?)");
            $stmt->execute([$member['player_id']]);
            $theirRankLevel = $stmt->fetchColumn();
            ?>
            <?php if ($myRankLevel > $theirRankLevel && $member['player_id'] != $_SESSION['player_id']): ?>
                <form method="POST" action="?page=mobInfo" class="absolute top-0 right-0">
                    <input type="hidden" name="target_player_id" value="<?= $member['player_id'] ?>">
                    <button type="submit" name="start_promotion_vote" class="text-xs bg-money-green text-white px-2 py-1 rounded-full hover:cursor-pointer">
                        Promote
                    </button>
                </form>
            <?php endif; ?>

            <div class="flex flex-row justify-between w-[75%]">
                <h1 class="font-koho font-bold text-black tracking-koho text-3xl sm:text-4xl md:text-5xl lg:text-5xl xl:text-6xl">
                    <?= htmlspecialchars($names[0]) ?>
                </h1>
                <?php include __DIR__ . '/../partials/avatarLevel.php'; ?>
            </div>
        </div>

    <?php else: ?>
        <div class="flex items-center justify-center gap-6 h-full px-16">
            <?php foreach ($names as $i => $singleName):
                $member = $memberData[$i];

                $stmt = $pdo->prepare("SELECT rank_level FROM `RANK` WHERE rank_id = (SELECT rank_id FROM PLAYER WHERE player_id = ?)");
                $stmt->execute([$member['player_id']]);
                $theirRankLevel = $stmt->fetchColumn();
            ?>
                <div class="relative w-[20%] aspect-square">
                    <label for="idCard<?= $member['player_id'] ?>" class="group relative block w-full h-full cursor-pointer">
                        <?php $img = $avatars[$i] ?? 'oldDude.png';
                        include __DIR__ . '/../partials/avatarImage.php'; ?>
                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1 rounded-md bg-black/85 text-white text-sm font-koho whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-150 pointer-events-none z-50">
                            <?= htmlspecialchars($singleName) ?>
                            <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-black/85"></div>
                        </div>
                    </label>

                    <?php if ($myRankLevel > $theirRankLevel && $member['player_id'] != $_SESSION['player_id']): ?>
                        <form method="POST" action="?page=mobInfo" class="absolute top-0 right-0">
                            <input type="hidden" name="target_player_id" value="<?= $member['player_id'] ?>">
                            <button type="submit" name="start_promotion_vote" class="text-xs bg-money-green text-white px-2 py-1 rounded-full hover:cursor-pointer">
                                Promote
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>