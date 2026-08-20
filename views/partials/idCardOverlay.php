<?php /** @var array $member */ ?>

<div class="hidden fixed inset-0 bg-black/70 z-[60] items-center justify-center" id="overlayFor<?= $member['player_id'] ?>">
    <label for="idCard<?= $member['player_id'] ?>" class="fixed inset-0 z-0"></label>

    <div class="relative z-10 flex flex-row gap-16 px-8 lg:px-15 lg:py-9 aspect-11/7 bg-[url('../public/img/IDCard.png')] bg-cover bg-center bg-no-repeat h-[70vh] drop-shadow-2xl/90">
        <div class="flex flex-1 flex-col justify-center items-center min-w-0">
            <img src="../public/img/avatars/<?= htmlspecialchars($member['avatar']) ?>" class="w-full aspect-square rounded-md object-cover lg:border-[15px] md:border-8 border-avatar-stroke">
        </div>
        <div class="flex flex-1 justify-center flex-col min-w-0 lg:gap-20 md:gap-12 sm:gap-12 gap-10 pt-4">
            <h1 class="font-koho font-bold lg:text-7xl md:text-6xl sm:text-5xl text-4xl tracking-koho drop-shadow-lg/50"><?= htmlspecialchars($member['username']) ?></h1>

            <div class="flex flex-col gap-2 sm:gap-3 md:gap-4 lg:gap-5">
                <div class="flex flex-row justify-between">
                    <h1 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey lg:text-4xl md:text-2xl sm:text-2xl text-1xl">Joined:</h1>
                    <h1 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey lg:text-4xl md:text-2xl sm:text-2xl text-1xl"><?= htmlspecialchars(date("d/m/Y", strtotime($member['created_at']))) ?></h1>
                </div>
                <div class="flex flex-row justify-between">
                    <h1 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey lg:text-4xl md:text-2xl sm:text-2xl text-1xl">Experience:</h1>
                    <h1 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey lg:text-4xl md:text-2xl sm:text-2xl text-1xl"><?= htmlspecialchars($member['xp']) ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>