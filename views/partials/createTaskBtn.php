<?php
$canCreateTask = in_array($player['rank_name'] ?? '', ['Soldier', 'Capo', 'Underboss'], true);
$forceOpen = isset($_GET['taskCreated']);
?>

<?php if ($canCreateTask): ?>
    <input type="checkbox" id="createTaskToggle" class="hidden peer" <?= $forceOpen ? 'checked' : '' ?>>

    <label for="createTaskToggle" class="w-[30%] px-3 py-1 sm:text-2xl sm:px-4 sm:py-1 md:text-4xl md:px-6 md:py-1.5 lg:text-4xl lg:py-1 transition-all duration-150 ease-in-out hover:cursor-pointer bg-amber-50 hover:bg-amber-100 shadow-2xl/33 hover:scale-102 text-black font-koho font-bold rounded-lg flex items-center justify-center">
        Create Task
    </label>

    <div class="hidden peer-checked:flex fixed inset-0 bg-black/70 z-50 items-center justify-center">
        <div class="bg-amber-50 p-8 rounded-lg w-[90%] max-w-md flex flex-col gap-4">
            <h2 class="font-koho font-bold text-3xl text-black text-center">Create Task</h2>

            <?php if ($forceOpen): ?>
                <p class="text-money-green font-inter font-bold text-center">Task created and assigned</p>
            <?php else: ?>
                <?php include __DIR__ . '/createTaskForm.php'; ?>
            <?php endif; ?>

            <label for="createTaskToggle" class="px-3 py-1 text-xl hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover text-white font-koho font-bold rounded-lg text-center block">
                Close
            </label>
        </div>
    </div>
<?php endif; ?>