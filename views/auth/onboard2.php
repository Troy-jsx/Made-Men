<body class="bg-[url('../public/img/LobbyBg.png')] bg-cover bg-center bg-no-repeat min-h-screen overflow-hidden">
    <div class='relative min-h-screen overflow-hidden'>
        <img src="../public/img/PaperStack.png" class='absolute aspect-[1/1] bottom-[-45dvh] right-[-57dvw]'>

        <div class="flex flex-row gap-16 px-15 py-9 absolute translate-x-[15%] translate-y-[15%] aspect-11/7 bg-[url('../public/img/IDCard.png')] bg-cover bg-center bg-no-repeat h-[80vh] drop-shadow-2xl/90">
            <div class="flex flex-1 flex-col justify-center items-center min-w-0">
                <img src="../public/img/avatars/oldDude.png" class="w-full aspect-[1/1] rounded-md object-cover lg:border-[15px] md:border-8 border-avatar-stroke">
            </div>
            <div class="flex flex-1 flex-col min-w-0 lg:gap-20 md:gap-12 pt-4 justify-center">
                <h1 class="font-koho font-bold lg:text-7xl md:text-5xl tracking-koho drop-shadow-lg/50">Joey_Torino</h1>
                <div class="w-full flex flex-row">
                    <div class="flex-1 flex flex-col gap-14">
                        <h2 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey md:text-4xl sm:text-2xl">Joined:</h2>
                        <h2 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey md:text-4xl sm:text-2xl">Experience:</h2>
                    </div>
                    <div class="flex-1 flex flex-col gap-14 text-right">
                        <h2 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey md:text-4xl sm:text-2xl">06/07/2026</h2>
                        <h2 class="font-koho tracking-koho font-bold drop-shadow-sm/40 text-light-grey md:text-4xl sm:text-2xl">Fresh</h2>
                    </div>
                </div>

                <?php
                    $nextPage = '?page=preGameMobSelect';
                    include __DIR__ . "/../partials/nextButton.php";;
                ?>
            </div>
        </div>
    </div>
</body> 