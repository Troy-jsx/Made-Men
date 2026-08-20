<?php
$canStartPerkVote = in_array($player['rank_name'] ?? '', ['Soldier', 'Capo', 'Underboss'], true);
?>

<?php if ($canStartPerkVote): ?>
    <?php
    $stmt = $pdo->prepare("
        SELECT tt.task_type_id, tt.type_name, tt.unlock_cost
        FROM TASK_TYPE tt
        WHERE tt.unlock_cost IS NOT NULL
        AND tt.task_type_id NOT IN (
        SELECT task_type_id FROM MOB_UNLOCKED_TASK_TYPE WHERE mob_id = (SELECT mob_id FROM PLAYER WHERE player_id = ?)
        )
    ");
    $stmt->execute([$_SESSION['player_id']]);
    $lockedTypes = $stmt->fetchAll();
    ?>

    <input type="checkbox" id="perkToggle" class="hidden">

    <label for="perkToggle" class="w-[30%] px-3 py-1 sm:text-2xl sm:px-4 sm:py-1 md:text-4xl md:px-6 md:py-1.5 lg:text-4xl lg:py-1 transition-all duration-150 ease-in-out hover:cursor-pointer bg-amber-50 hover:bg-amber-100 shadow-2xl/33 hover:scale-102 text-black font-koho font-bold rounded-lg flex items-center justify-center">
        Unlock Perk
    </label>

    <div class="hidden fixed inset-0 bg-black/70 z-50 items-center justify-center" id="perkOverlay">
        <label for="perkToggle" class="fixed inset-0 z-0"></label>

        <div class="relative z-10 bg-amber-50 p-8 rounded-lg w-[90%] max-w-md flex flex-col gap-4">
            <h2 class="font-koho font-bold text-3xl text-black text-center">Unlock Perk</h2>

            <?php if (empty($lockedTypes)): ?>
                <p class="font-inter text-black/70 text-center">Everything's already unlocked.</p>
            <?php else: ?>
                <?php foreach ($lockedTypes as $type): ?>
                    <form method="POST" class="flex flex-row justify-between items-center gap-3">
                        <span class="font-koho font-bold text-black"><?= htmlspecialchars($type['type_name']) ?>: $<?= (int)$type['unlock_cost'] ?></span>
                        <input type="hidden" name="task_type_id" value="<?= $type['task_type_id'] ?>">
                        <button type="submit" name="start_perk_vote" class="px-3 py-1 text-sm hover:cursor-pointer bg-money-green hover:bg-money-green-hover text-white font-koho font-bold rounded-lg">
                            Vote
                        </button>
                    </form>
                <?php endforeach; ?>
            <?php endif; ?>

            <label for="perkToggle" class="px-3 py-1 text-xl hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover text-white font-koho font-bold rounded-lg text-center block">
                Close
            </label>
        </div>
    </div>

    <style>
        #perkToggle:checked ~ #perkOverlay { display: flex !important; }
    </style>
<?php endif; ?>