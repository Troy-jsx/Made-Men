<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = "Please enter both username and password.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT player_id, password_hash, avatar, mob_id FROM PLAYER WHERE username = ?");
        $stmt->execute([$username]);
        $player = $stmt->fetch();

        if (!$player || !password_verify($password, $player['password_hash'])) {
            $errors[] = "Incorrect username or password.";
        } else {
            $_SESSION['player_id'] = $player['player_id'];

            if ($player['avatar'] === null) {
                header("Location: ?page=onboard1");
            } elseif ($player['mob_id'] === null) {
                header("Location: ?page=midGameMobSelect");
            } else {
                header("Location: ?page=gameScreen");
            }
            exit;
        }
    }
}
?>

<body class="bg-[url('../public/img/LobbyBg.png')] bg-cover bg-center bg-no-repeat min-h-screen">
    <div class='min-h-screen overflow-hidden relative'>

        <div class="flex flex-row gap-16 px-12 pt-15 sm:px-17 sm:pt-15 md:px-20 md:pt-22 lg:px-25 lg:pt-30 absolute right-0 bottom-0 aspect-1331/897 bg-[url('../public/img/BookShadow.png')] bg-cover bg-center bg-no-repeat h-[95vh] drop-shadow-2xl/90">
            <?php
            include '../views/partials/LoginForm.php';
            ?>
        </div>

        <img src="../public/img/PaperStack.png" class='absolute aspect-square bottom-[-45dvh] right-[-57dvw]'>
    </div>
</body>