<body class="bg-[url('../public/img/LobbyBg.png')] bg-cover bg-center bg-no-repeat min-h-screen overflow-hidden">
    <div class='relative min-h-screen overflow-hidden'>
        <img src="../public/img/PaperStack.png" class='absolute aspect-[1/1] bottom-[-45dvh] right-[-57dvw]'>

        <div class="flex flex-row gap-16 px-8 lg:px-15 lg:py-9 absolute translate-x-[15%] translate-y-[15%] aspect-11/7 bg-[url('../public/img/IDCard.png')] bg-cover bg-center bg-no-repeat h-[80vh] drop-shadow-2xl/90">
            <div class="flex flex-1 flex-col justify-center items-center min-w-0">
                <img src="../public/img/avatars/oldDude.png" class="w-full aspect-[1/1] rounded-md object-cover lg:border-[15px] md:border-8 border-avatar-stroke">
            </div>
            <div class="flex flex-1 justify-center flex-col min-w-0 lg:gap-8 md:gap-6 sm:gap-6 gap-5 pt-4">
                <h1 class="font-koho font-bold lg:text-6xl md:text-5xl sm:text-4xl text-3xl tracking-koho drop-shadow-lg/50">Joey_Torino</h1>
                <div class="grid grid-cols-3 gap-0.5 sm:gap-1 md:gap-2 w-full min-w-0">
                    <?php
                        $avatarImages = [
                            "../public/img/avatars/oldDude.png",
                            "../public/img/avatars/fedoraDude.png",
                            "../public/img/avatars/yakuzaDude.png",
                            "../public/img/avatars/beardDude.png",
                            "../public/img/avatars/fancyWoman.png",
                            "../public/img/avatars/irishWoman.png",
                        ];

                        foreach ($avatarImages as $img){
                            include __DIR__ . "/../partials/avatarSelect.php";
                        }
                    
                    ?>
                </div>
                <?php
                    $nextPage = '?page=onboard2';
                    include __DIR__ . "/../partials/nextButton.php";;
                ?>
            </div>
        </div>
    </div>
</body> 