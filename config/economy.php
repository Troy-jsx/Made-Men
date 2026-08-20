<?php
function runEconomyTick($pdo)
{
    $mobs = $pdo->query("SELECT mob_id, balance, last_income_collection, last_toll_payment, daily_toll FROM MOB WHERE eliminated = FALSE")->fetchAll();

    foreach ($mobs as $mob) {
        $hoursElapsed = floor((time() - strtotime($mob['last_income_collection'])) / 3600);
        if ($hoursElapsed > 0) {
            $income = $pdo->prepare("SELECT COALESCE(SUM(income_per_hour), 0) FROM TERRITORY WHERE mob_id = ?");
            $income->execute([$mob['mob_id']]);
            $totalIncome = $income->fetchColumn() * $hoursElapsed;

            if ($totalIncome > 0) {
                $pdo->prepare("UPDATE MOB SET balance = balance + ? WHERE mob_id = ?")
                    ->execute([$totalIncome, $mob['mob_id']]);
            }
            $pdo->prepare("UPDATE MOB SET last_income_collection = NOW() WHERE mob_id = ?")
                ->execute([$mob['mob_id']]);
        }

        $daysElapsed = floor((time() - strtotime($mob['last_toll_payment'])) / 86400);
        if ($daysElapsed > 0) {
            $currentBalance = $pdo->prepare("SELECT balance FROM MOB WHERE mob_id = ?");
            $currentBalance->execute([$mob['mob_id']]);
            $balance = $currentBalance->fetchColumn();

            if ($balance < $mob['daily_toll']) {
                eliminateMob($pdo, $mob['mob_id']);
                continue;
            } else {
                $pdo->prepare("UPDATE MOB SET balance = balance - ?, last_toll_payment = NOW() WHERE mob_id = ?")
                    ->execute([$mob['daily_toll'], $mob['mob_id']]);
            }
        }

        $territoryCount = $pdo->prepare("SELECT COUNT(*) FROM TERRITORY WHERE mob_id = ?");
        $territoryCount->execute([$mob['mob_id']]);
        $hasTerritory = $territoryCount->fetchColumn() > 0;

        $currentBalance = $pdo->prepare("SELECT balance FROM MOB WHERE mob_id = ?");
        $currentBalance->execute([$mob['mob_id']]);
        $balance = $currentBalance->fetchColumn();

        if (!$hasTerritory || $balance < 0) {
            eliminateMob($pdo, $mob['mob_id']);
        }
    }
}

function eliminateMob($pdo, $mobId)
{
    $pdo->prepare("UPDATE MOB SET eliminated = TRUE WHERE mob_id = ?")->execute([$mobId]);

    $pdo->prepare("UPDATE TERRITORY SET mob_id = NULL WHERE mob_id = ?")->execute([$mobId]);

    $pdo->prepare("UPDATE PLAYER SET mob_id = NULL, rank_id = 1 WHERE mob_id = ?")->execute([$mobId]);
}
