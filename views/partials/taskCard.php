<div class="group border-black flex flex-col border-4 gap-5 sm:px-4 px-2 py-1 sm:py-2 md:px-6 md:py-3 lg:px-8 lg:py-4 rounded-xl cursor-default select-none">
    <div class="flex flex-row gap-2 lg:gap-6 items-center justify-center">
        <div class="bg-[url('../public/img/avatars/fedoraDude.png')] bg-cover w-[30%] aspect-square rounded-md border-border-brown border-4">

        </div>
        <div class="w-[60%] flex flex-col sm:gap-3 lg:gap-2 justify-center h-full">
            <div class="flex flex-col text-left justify-between">
                <h1 class="font-koho tracking-koho font-medium text-md sm:text-lg md:text-xl lg:text-2xl drop-shadow-lg/20 text-gray-800 underline text-left w-full">Joey</h1>
                <div class="flex flex-row justify-between w-full">
                    <h1 class="font-koho tracking-koho font-bold text-2xl sm:text-2xl md:text-3xl lg:text-5xl drop-shadow-lg/20 text-black text-left w-full">Intel</h1>
                    <h1 class="text-koho text-money-green font-bold tracking-koho text-4xl">$12</h1>
                </div>
            </div>
            <div class="flex flex-row justify-between">
                <h1 class="font-inter tracking-koho font-medium text-md  sm:text-md md:text-lg lg:text-xl drop-shadow-md/20 text-black/90 text-left w-full">Gather information on a local business.</h1>
            </div>
        </div>
    </div>
    <div class="max-h-0 overflow-hidden flex flex-row gap-4 group-hover:max-h-100 transition-all ease-in-out duration-350">
        <?php include __DIR__ . '/../partials/acceptBtn.php';?>
        <?php include __DIR__ . '/../partials/declineBtn.php';?>
    </div>
</div>