<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $errors[] = "All fields are required.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT player_id FROM PLAYER WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $errors[] = "Username or email already taken.";
        }
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO PLAYER (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hash]);

        $_SESSION['player_id'] = $pdo->lastInsertId();

        header("Location: ?page=onboard1");
        exit;
    }
}
?>

<body class="bg-[url('../public/img/LobbyBg.png')] bg-cover bg-center bg-no-repeat min-h-screen">
    <div class='min-h-screen overflow-hidden relative'>

        <div class="flex flex-row gap-16 px-12 pt-15 sm:px-17 sm:pt-15 md:px-20 md:pt-22 lg:px-30 lg:pt-25 absolute right-0 bottom-0 aspect-1331/897 bg-[url('../public/img/BookShadow.png')] bg-cover bg-center bg-no-repeat h-[95vh] drop-shadow-2xl/90">
            <?php
                include '../views/partials/signupForm.php';
            ?>
        </div>

        <img src="../public/img/PaperStack.png" class='absolute aspect-square bottom-[-45dvh] right-[-57dvw]'>
    </div>
</body>