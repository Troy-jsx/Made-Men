<?php
$mobColors = [
    'Salerno'   => ['bg' => 'bg-red-500',    'text' => 'text-red-500'],
    'Brennan'   => ['bg' => 'bg-green-500',  'text' => 'text-green-500'],
    'Ishikawa'  => ['bg' => 'bg-purple-500', 'text' => 'text-purple-500'],
    'Salazar'   => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-500'],
    'unclaimed' => ['bg' => 'bg-gray-400',   'text' => 'text-gray-400'],
];

$territories = [
    ['name' => "Industrial Quarter", 'top' => 38, 'left' => 20, 'owner' => 'Salerno', 'description' => "Rows of shuttered mills and factories, thick with smoke and secrets."],
    ['name' => "Factories", 'top' => 15, 'left' => 15, 'owner' => 'Salerno', 'description' => "The old manufacturing district, still churning out goods under the family's watch."],
    ['name' => "The Park", 'top' => 35, 'left' => 85, 'owner' => 'Brennan', 'description' => "A sprawling green space in the heart of the city, popular by day, dangerous by night."],
    ['name' => "Dock Alley", 'top' => 75, 'left' => 63, 'owner' => 'Ishikawa', 'description' => "Tight backstreets near the harbour, ideal for moving goods unseen."],
    ['name' => "Delmonico's", 'top' => 20, 'left' => 50, 'owner' => 'Ishikawa', 'description' => "A high-end restaurant that doubles as neutral ground for family meetings."],
    ['name' => "Downtown", 'top' => 60, 'left' => 80, 'owner' => 'Brennan', 'description' => "The bustling commercial core of the city, valuable and heavily contested."],
    ['name' => "The Residence", 'top' => 65, 'left' => 47, 'owner' => 'Salazar', 'description' => "A quiet residential block, easy to overlook but useful for laying low."],
    ['name' => "Shipping Depot", 'top' => 88, 'left' => 25, 'owner' => 'unclaimed', 'description' => "A depot at the edge of town, ripe for the taking."],
];
?>

<div class="absolute top-0 left-0 w-[65vw] h-screen">
    <img src="../public/img/Map.png" class="w-full h-full object-cover">

    <?php foreach ($territories as $territory): ?>
        <?php $color = $mobColors[$territory['owner']] ?? $mobColors['unclaimed'];?>
        <div
            class="group absolute -translate-x-1/2 -translate-y-1/2"
            style="top: <?= $territory['top'] ?>%; left: <?= $territory['left'] ?>%;">
            <div class="aspect-square transition-all duration-100 hover:scale-125 w-7 rounded-full <?= $color['bg'] ?> border-2 border-white drop-shadow-lg/90"></div>

            <div class="flex flex-col absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 pt-2 pb-3 rounded-md bg-black/85 text-white text-sm font-koho w-[350px] opacity-0 group-hover:opacity-100 transition-opacity duration-150 pointer-events-none z-50">
                <span class="font-bold text-2xl"><?= htmlspecialchars($territory['name']) ?></span>
                <span class="font-semibold text-xl  <?= $color['text'];?> ?>"><?= htmlspecialchars($territory['owner']) ?></span>
                <span class="font-medium text-sm"><?= htmlspecialchars($territory['description']) ?></span>
                <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-black/85"></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>