<?php
/** @var array $names */
/** @var string $position */ //it was shouting at me for some reason so i gotta tell em that we got this stuff for somewhere else fr
?>

<div class="relative aspect-690/175 w-[60%] bg-[url('../public/img/cardPaperBG.png')] drop-shadow-xl/80 bg-cover bg-no-repeat">
    <h1 class="absolute top-[-5vh] left-0 translate-x-[2.5vw] font-koho font-bold tracking-koho text-white text-2xl sm:text-3xl md:text-4xl lg:text-4xl xl:text-5xl drop-shadow-lg/80 whitespace-nowrap">
        <?= $position ?>
    </h1>

    <?php if (count($names) === 1): ?>
        <div class="flex items-center justify-between h-full px-16">
            <div class="w-[20%] aspect-square">
                <?php
                $img = "../public/img/avatars/oldDude.png";
                include __DIR__ . '/../partials/avatarSelect.php';
                ?>
            </div>
            <div class="flex flex-row justify-between w-[75%]">
                <h1 class="font-koho font-bold text-black tracking-koho text-3xl sm:text-4xl md:text-5xl lg:text-5xl xl:text-6xl">
                    <?= $names[0] ?>
                </h1>
                <?php include __DIR__ . '/../partials/avatarLevel.php'; ?>
            </div>
        </div>

    <?php else: ?>
        <div class="flex items-center justify-center gap-6 h-full px-16">
            <?php foreach ($names as $singleName): ?>
                <div class="w-[20%] aspect-square">
                    <?php
                    $img = "../public/img/avatars/oldDude.png";
                    include __DIR__ . '/../partials/avatarSelect.php';
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>