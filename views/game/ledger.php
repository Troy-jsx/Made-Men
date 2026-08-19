<body class="bg-[url('../public/img/LobbyBg.png')] bg-cover bg-center bg-no-repeat min-h-screen">
    <div class='min-h-screen overflow-hidden relative'>

        <div class="flex flex-col gap-16 px-12 pt-40 lg:px-25 absolute right-0 bottom-0 aspect-1331/897 bg-[url('../public/img/BookShadow.png')] bg-cover bg-center bg-no-repeat h-[95vh] drop-shadow-2xl/90">
            <div class="flex flex-col gap-8 w-[48%]">
                <div class="h-fit gap-4 w-full flex flex-row">
                    <?php include '../views/partials/ledgerContent.php'; ?>
                    <?php include '../views/partials/ledgerContent.php'; ?>
                </div>

                <div class="h-fit gap-4 justify-between w-full flex flex-row">
                    <?php include '../views/partials/ledgerContent.php'; ?>
                </div>
            </div>
            <div class="w-[30%]"> <?php include __DIR__ . '/../partials/backBtn.php';?></div>
        </div>

        <img src="../public/img/PaperStack.png" class='absolute aspect-square bottom-[-45dvh] right-[-57dvw]'>
    </div>
</body>