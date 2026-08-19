<body class="bg-[url('../public/img/WoodBG.png')] bg-cover bg-center bg-no-repeat min-h-screen overflow-hidden select-none relative">
    <?php include __DIR__ . '/../partials/mobInfoBar.php'; ?>

    <div class="absolute top-0 right-0 w-[65vw] h-screen">
        <?php include __DIR__ . '/../partials/MobMembers.php'; ?>
    </div>

    <a href="?page=ledger" class="absolute -bottom-4 rotate-6 -left-4">
        <div class="aspect-425/253 w-fit bg-[url('../public/img/ledgerBG.png')] gap-8 pt-5 pb-8 flex flex-col items-center px-7 bg-cover rounded-lg drop-shadow-2xl/33 hover:scale-105 transition-all duration-150 ease-in-out hover:cursor-pointer">
            <h1 class="font-koho font-bold text-6xl">Open Ledger</h1>
            <h1 class="text-koho text-money-green font-bold tracking-koho text-7xl">$5312</h1>
        </div>
    </a>

    <a href="?page=gameScreen" class="absolute top-4 right-4">
        <button type="button" class='px-3 py-1 sm:text-2xl sm:px-4 sm:py-1 md:text-4xl md:px-6 md:py-1.5 lg:text-6xl lg:py-2 transition-all duration-150 ease-in-out hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg'>
            Back
        </button>
    </a>
</body>