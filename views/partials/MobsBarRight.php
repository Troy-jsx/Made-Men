<?php
$totalTerritories = (int) $pdo->query("SELECT COUNT(*) FROM TERRITORY")->fetchColumn();

$stmt = $pdo->query("
    SELECT m.mob_id, m.mob_name, m.image, m.member_cap,
    COUNT(DISTINCT p.player_id) AS current_count,
    COUNT(DISTINCT t.territory_id) AS territories_owned
    FROM MOB m
    LEFT JOIN PLAYER p ON p.mob_id = m.mob_id
    LEFT JOIN TERRITORY t ON t.mob_id = m.mob_id
    WHERE m.eliminated = FALSE
    GROUP BY m.mob_id, m.mob_name, m.image, m.member_cap
");
$mobs = $stmt->fetchAll();
?>

<div class='min-h-screen overflow-hidden relative'>
    <div class="bg-[url('../public/img/paperBGVertical.png')] flex-col min-h-[110vh] rotate-3 translate-x-[5vw] pb-[53vh] translate-y-[-20vh] drop-shadow-[0px_0px_30px_rgba(0,0,0,1)] flex align-center bg-cover bg-no-repeat absolute right-0 w-[40vw] aspect-843/1862 scale-x-[-1]">
        <div class="pt-[22vh] pl-[4vw] pr-[8vw] flex flex-col items-center h-full w-full scale-x-[-1]">
            <div class="align-center w-full h-full transform -rotate-3 flex flex-col gap-6 min-h-0">
                <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-9xl text-mmRed text-center font-koho tracking-koho font-bold drop-shadow-lg/80">Mobs</h1>

                <?php if (!empty($errors)): ?>
                    <?php foreach ($errors as $error): ?>
                        <p class="text-mmRed font-koho tracking-koho font-medium text-3xl"><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="w-full flex flex-col gap-6 overflow-y-auto min-h-0 scrollbar-none">
                    <?php foreach ($mobs as $mob): ?>
                        <?php include __DIR__ . '/FamilyCard.php'; ?>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>