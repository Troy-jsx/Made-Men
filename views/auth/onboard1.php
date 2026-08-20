<?php
if (!isset($_SESSION['player_id'])) {
    header("Location: ?page=signup");
    exit;
}

$stmt = $pdo->prepare("SELECT username, avatar FROM PLAYER WHERE player_id = ?");
$stmt->execute([$_SESSION['player_id']]);
$player = $stmt->fetch();

$errors = [];

$avatarImages = [
    "oldDude.png",
    "fedoraDude.png",
    "yakuzaDude.png",
    "beardDude.png",
    "fancyWoman.png",
    "irishWoman.png",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avatar = $_POST['avatar'] ?? '';

    if (!in_array($avatar, $avatarImages, true)) {
        $errors[] = "Please select an avatar.";
    } else {
        $stmt = $pdo->prepare("UPDATE PLAYER SET avatar = ? WHERE player_id = ?");
        $stmt->execute([$avatar, $_SESSION['player_id']]);

        header("Location: ?page=onboard2");
        exit;
    }
}

$selectedAvatar = $player['avatar'] ?? 'oldDude.png';
?>

<body class="bg-[url('../public/img/LobbyBg.png')] bg-cover bg-center bg-no-repeat min-h-screen overflow-hidden">
    <div class='relative min-h-screen overflow-hidden'>
        <img src="../public/img/PaperStack.png" class='absolute aspect-[1/1] bottom-[-45dvh] right-[-57dvw]'>

        <form method="POST" class="flex flex-row gap-16 px-8 lg:px-15 lg:py-9 justify-center  absolute translate-x-[15%] translate-y-[15%] aspect-11/7 bg-[url('../public/img/IDCard.png')] bg-cover bg-center bg-no-repeat h-[80vh] drop-shadow-2xl/90">
            <div class="flex flex-1 flex-col justify-center items-center min-w-0 relative">
                <?php foreach ($avatarImages as $img): ?>
                    <img
                        src="../public/img/avatars/<?= htmlspecialchars($img) ?>"
                        data-preview-for="<?= htmlspecialchars($img) ?>"
                        class="preview-img absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full aspect-[1/1] rounded-md object-cover lg:border-[15px] md:border-8 border-avatar-stroke opacity-0 <?= ($selectedAvatar === $img) ? '!opacity-100' : '' ?>">
                <?php endforeach; ?>
            </div>
            <div class="flex flex-1 justify-center flex-col min-w-0 lg:gap-8 md:gap-6 sm:gap-6 gap-5 pt-4">
                <h1 class="font-koho font-bold lg:text-6xl md:text-5xl sm:text-4xl text-3xl tracking-koho drop-shadow-lg/50"><?= htmlspecialchars($player['username']) ?></h1>

                <?php if (!empty($errors)): ?>
                    <p class="text-mmRed font-inter font-medium"><?= htmlspecialchars($errors[0]) ?></p>
                <?php endif; ?>

                <div class="grid grid-cols-3 gap-0.5 sm:gap-1 md:gap-2 w-full min-w-0">
                    <?php foreach ($avatarImages as $img) {
                        include __DIR__ . "/../partials/avatarSelect.php";
                    } ?>
                </div>

                <button type="submit" class='px-3 py-1 sm:text-2xl sm:px-4 sm:py-1 md:text-4xl md:px-6 md:py-1.5 lg:text-6xl lg:py-2 transition-all duration-150 ease-in-out hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg w-fit'>
                    Next
                </button>
            </div>
        </form>
    </div>

    <style>
        <?php foreach ($avatarImages as $img): ?>form:has(input[value="<?= $img ?>"]:checked) img[data-preview-for="<?= $img ?>"] {
            opacity: 1 !important;
        }

        <?php endforeach; ?>
    </style>
</body>