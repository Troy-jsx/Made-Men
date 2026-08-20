<?php
if (!isset($_SESSION['player_id'])) {
    header("Location: ?page=signup");
    exit;
}

$stmt = $pdo->prepare("SELECT balance, daily_toll, last_toll_payment FROM MOB WHERE mob_id = (SELECT mob_id FROM PLAYER WHERE player_id = ?)");
$stmt->execute([$_SESSION['player_id']]);
$mob = $stmt->fetch();

$hoursSincePayment = (time() - strtotime($mob['last_toll_payment'])) / 3600;
$hoursUntilDue = max(0, ceil(24 - $hoursSincePayment));

$survivalEstimate = $mob['balance'] - $mob['daily_toll'];
?>

<body class="bg-[url('../public/img/LobbyBg.png')] bg-cover bg-center bg-no-repeat min-h-screen">
    <div class='min-h-screen overflow-hidden relative'>

        <div class="flex flex-col gap-16 px-12 pt-40 lg:px-25 absolute right-0 bottom-0 aspect-1331/897 bg-[url('../public/img/BookShadow.png')] bg-cover bg-center bg-no-repeat h-[95vh] drop-shadow-2xl/90">
            <div class="flex flex-col gap-8 w-[48%]">
                <div class="h-fit gap-4 w-full flex flex-row">
                    <?php
                    $title = 'Balance';
                    $status = $mob['balance'] >= 0 ? 'Positive' : 'Negative';
                    $amount = $mob['balance'];
                    $description = $mob['balance'] >= 0 ? 'We have some money in the bank.' : "We're in the red.";
                    include '../views/partials/ledgerCard.php';
                    ?>

                    <?php
                    $title = 'Bribe';
                    $status = 'Due';
                    $amount = -$mob['daily_toll'];
                    $description = "Due in {$hoursUntilDue} hour" . ($hoursUntilDue === 1 ? '' : 's') . '.';
                    include '../views/partials/ledgerCard.php';
                    ?>
                </div>

                <div class="h-fit gap-4 justify-between w-full flex flex-row">
                    <?php
                    $title = 'After Bribe';
                    $status = $survivalEstimate >= 0 ? 'Positive' : 'Negative';
                    $amount = $survivalEstimate;
                    $description = $survivalEstimate >= 0 ? "We'll survive the day." : "We're going to be wiped out.";
                    include '../views/partials/ledgerCard.php';
                    ?>
                </div>
            </div>
            <div class="w-[30%]"> <?php include __DIR__ . '/../partials/backBtn.php'; ?></div>
        </div>

        <img src="../public/img/PaperStack.png" class='absolute aspect-square bottom-[-45dvh] right-[-57dvw]'>
    </div>
</body>