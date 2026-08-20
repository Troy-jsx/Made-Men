<?php
$mobColors = [
    'The Salerno Family'   => ['bg' => 'bg-red-500',    'text' => 'text-red-500'],
    'The Brennan Family'   => ['bg' => 'bg-green-500',  'text' => 'text-green-500'],
    'The Ishikawa-kai'  => ['bg' => 'bg-purple-500', 'text' => 'text-purple-500'],
    'The Salazar Cartel'   => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-500'],
    'Unclaimed' => ['bg' => 'bg-gray-400',   'text' => 'text-gray-400'],
];

$stmt = $pdo->prepare("SELECT mob_id FROM PLAYER WHERE player_id = ?");
$stmt->execute([$_SESSION['player_id']]);
$myMobId = $stmt->fetchColumn();

$stmt = $pdo->query("
    SELECT t.territory_id, t.territory_name, t.description, t.top_pct, t.left_pct, t.mob_id, m.mob_name
    FROM TERRITORY t
    LEFT JOIN MOB m ON m.mob_id = t.mob_id
");

$territories = $stmt->fetchAll();

?>

<div class="absolute top-0 left-0 w-[65vw] h-screen">
    <img src="../public/img/Map.png" class="w-full h-full object-cover">

    <?php foreach ($territories as $territory):
        $owner = $territory['mob_name'] ?? 'Unclaimed';
        $color = $mobColors[$owner];
    ?>
        <div
            class="group absolute -translate-x-1/2 -translate-y-1/2"
            style="top: <?= $territory['top_pct'] ?>%; left: <?= $territory['left_pct'] ?>%;">
            <div class="aspect-square transition-all duration-100 hover:scale-125 w-7 rounded-full <?= $color['bg'] ?> border-2 border-white drop-shadow-lg/90"></div>

            <div class="flex flex-col absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 pt-2 pb-3 rounded-md bg-black/85 text-white text-sm font-koho w-[350px] opacity-0 group-hover:opacity-100 transition-opacity duration-150 z-50">
                <span class="font-bold text-2xl"><?= htmlspecialchars($territory['territory_name']) ?></span>
                <span class="font-semibold text-xl <?= $color['text']; ?>"><?= htmlspecialchars($territory['mob_name'] ?? 'Unclaimed') ?></span>
                <span class="font-medium text-sm"><?= htmlspecialchars($territory['description']) ?></span>

                <?php if ($territory['mob_id'] != $myMobId): ?>
                    <form method="POST" class="pointer-events-auto mt-2">
                        <input type="hidden" name="territory_id" value="<?= $territory['territory_id'] ?>">
                        <button type="submit" name="start_territory_vote" class="w-full text-xs bg-money-green hover:bg-money-green-hover text-white font-koho font-bold px-2 py-1 rounded hover:cursor-pointer">
                            Vote to Take
                        </button>
                    </form>
                <?php endif; ?>

                <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-black/85"></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>