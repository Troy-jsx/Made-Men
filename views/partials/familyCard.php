<?php $controlPct = $totalTerritories > 0 ? round($mob['territories_owned'] / $totalTerritories * 100) : 0; ?>

<div class="group border-black flex flex-col border-4 gap-5 sm:px-4 px-2 py-1 sm:py-2 md:px-6 md:py-3 lg:px-8 lg:py-4 rounded-xl cursor-default select-none">
    <h1 class="font-koho tracking-koho font-bold text-2xl sm:text-2xl md:text-3xl lg:text-5xl text-black text-center w-full"><?= htmlspecialchars($mob['mob_name']) ?></h1>
    <div class="flex flex-row gap-2 lg:gap-4 items-center justify-center">
        <div class="bg-[url('../public/img/bosses/<?= htmlspecialchars($mob['image']) ?>')] bg-cover w-[30%] aspect-square bg-amber-50 rounded-md border-border-brown border-4">

        </div>
        <div class="w-[60%] flex flex-col sm:gap-3 lg:gap-8 justify-center h-full">
            <div class="flex flex-row justify-between">
                <h1 class="font-koho tracking-koho font-bold text-light-black lg:text-3xl md:text-2xl sm:text-2xl text-1xl">Players:</h1>
                <h1 class="font-TNR tracking-koho font-bold text-light-black lg:text-3xl md:text-2xl sm:text-2xl text-1xl"><?= (int)$mob['current_count'] ?>/<?= (int)$mob['member_cap'] ?></h1>
            </div>
            <div class="flex flex-row justify-between">
                <h1 class="font-koho tracking-koho font-bold text-light-black lg:text-3xl md:text-2xl sm:text-2xl text-1xl">Control:</h1>
                <h1 class="font-TNR tracking-koho font-bold text-light-black lg:text-3xl md:text-2xl sm:text-2xl text-1xl"><?= $controlPct ?>%</h1>
            </div>
        </div>
    </div>
    <div class="max-h-0 overflow-hidden group-hover:max-h-100 transition-all ease-in-out duration-350">
        <form method="POST">
            <input type="hidden" name="mob_id" value="<?= $mob['mob_id'] ?>">
            <button type="submit" class='px-3 py-1 sm:text-2xl sm:px-2 sm:py-1 md:text-3xl md:px-6 lg:text-4xl transition-all duration-150 ease-in-out hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg w-full'>
                Join
            </button>
        </form>
    </div>
</div>