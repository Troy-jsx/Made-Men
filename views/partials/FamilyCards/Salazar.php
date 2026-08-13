<div class="group border-black flex flex-col border-4 gap-5 sm:px-4 px-2 py-1 sm:py-2 md:px-6 md:py-3 lg:px-8 lg:py-4 rounded-xl cursor-default select-none">
    <h1 class="font-koho tracking-koho font-bold text-2xl sm:text-2xl md:text-3xl lg:text-5xl text-black text-center w-full">The Salazar Family</h1>
    <div class="flex flex-row gap-2 lg:gap-4 items-center justify-center">
        <div class="bg-[url('../public/img/bosses/Salazar.png')] bg-cover w-[30%] aspect-square bg-amber-50 rounded-md border-border-brown border-4">

        </div>
        <div class="w-[60%] flex flex-col sm:gap-3 lg:gap-8 justify-center h-full">
            <div class="flex flex-row justify-between">
                <h1 class="font-koho tracking-koho font-bold text-light-black lg:text-4xl md:text-2xl sm:text-2xl text-1xl">Players:</h1>
                <h1 class="font-TNR tracking-koho font-bold text-light-black lg:text-4xl md:text-2xl sm:text-2xl text-1xl">19/30</h1>
            </div>
            <div class="flex flex-row justify-between">
                <h1 class="font-koho tracking-koho font-bold text-light-black lg:text-4xl md:text-2xl sm:text-2xl text-1xl">Control:</h1>
                <h1 class="font-TNR tracking-koho font-bold text-light-black lg:text-4xl md:text-2xl sm:text-2xl text-1xl">0%</h1>
            </div>
        </div>
    </div>
    <div class="max-h-0 overflow-hidden group-hover:max-h-100 transition-all ease-in-out duration-350">
        <?php $nextPage = '?page=gameScreen'; ?>
        <?php
            include __DIR__ . '/../joinButton.php';
        ?>
    </div>
</div>