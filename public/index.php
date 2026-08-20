<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Made Men</title>
    <link href="../src/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<?php
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/../config/economy.php';

session_start(); // we start a session for our dude

if (isset($_SESSION['player_id'])) {
    runEconomyTick($pdo);
}



$page = $_GET['page'] ?? 'signup';
// gets the dude's current url and if it like not there or smth we set it to signup

$routes = [
    // dir is THIS files path and we concat it to the route we want so it takes it to the right place
    'signup' => __DIR__ . '/../views/auth/signup.php',
    'login' => __DIR__ . '/../views/auth/login.php',
    'onboard1' => __DIR__ . '/../views/auth/onboard1.php',
    'onboard2' => __DIR__ . '/../views/auth/onboard2.php',
    'preGameMobSelect' => __DIR__ . '/../views/game/preGameMobSelect.php',
    'gameScreen' => __DIR__ . '/../views/game/gameScreen.php',
    'midGameMobSelect' => __DIR__ . '/../views/game/midGameMobSelect.php',
    'mobInfo' => __DIR__ . '/../views/game/mobInfoPage.php',
    'ledger' => __DIR__ . '/../views/game/ledger.php',
    'logout' => __DIR__ . '/../views/auth/logout.php',
];
//echo $routes[$page];

if (array_key_exists($page, $routes)) { //are they real 
    include $routes[$page]; //send to the page we need using the array
} else {
    echo "Page not found."; //uh oh we lost
}
?>

</html>