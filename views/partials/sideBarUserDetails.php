<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-4">
        <div class="group border-black flex flex-col border-4 gap-5 sm:px-4 px-2 py-1 sm:py-2 md:px-6 md:py-3 lg:px-8 lg:py-4 rounded-xl cursor-default select-none">
        <div class="flex flex-row gap-2 lg:gap-6 items-center justify-center">
            <div style="background-image: url('../public/img/avatars/<?= htmlspecialchars($player['avatar']) ?>')" class="bg-cover w-[30%] aspect-square rounded-md border-border-brown border-4">

            </div>
            <div class="w-[60%] flex flex-col sm:gap-3 lg:gap-2 justify-center h-full">
                <div class="flex flex-row justify-between">
                    <h1 class="font-koho tracking-koho font-bold text-2xl sm:text-2xl md:text-3xl lg:text-5xl drop-shadow-lg/20 text-black text-left w-full"><?= $player['username'] ?></h1>
                </div>
                <div class="flex flex-row justify-between">
                    <h1 class="font-koho tracking-koho font-bold text-lg sm:text-xl md:text-2xl lg:text-3xl text-black/80 text-left w-full"><?= $player['mob_name'] ?></h1>
                </div>
            </div>
            <div>
                <?php include __DIR__ . '/../partials/avatarLevel.php';?>
            </div>
        </div>
    </div>

    <div class="flex fle-row w-full justify-between">
        <h1 class="text-koho text-money-green font-bold tracking-koho text-4xl">$<?= $player['cash'];?></h1>
        <h1 class="text-koho text-black font-bold tracking-koho text-4xl"><?= $player['rank_name'] ?></h1>
    </div>
    </div>

    <div class="w-full h-[5px] bg-black opacity-50 rounded-4xl"></div>
</div>