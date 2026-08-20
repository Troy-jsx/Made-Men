<?php
$createErrors = [];

$stmt = $pdo->prepare("SELECT rank_level FROM `RANK` WHERE rank_id = (SELECT rank_id FROM PLAYER WHERE player_id = ?)");
$stmt->execute([$_SESSION['player_id']]);
$myRankLevel = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT rank_id, rank_name FROM `RANK` WHERE rank_level < ? ORDER BY rank_level DESC");
$stmt->execute([$myRankLevel]);
$targetRanks = $stmt->fetchAll();

$taskTypes = $pdo->query("SELECT task_type_id, type_name FROM TASK_TYPE")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_task'])) {
    $taskTypeId = (int) ($_POST['task_type_id'] ?? 0);
    $assignedRankId = (int) ($_POST['assigned_rank_id'] ?? 0);

    $stmt = $pdo->prepare("
        SELECT created_at FROM TASK
        WHERE created_by = ?
        ORDER BY task_id DESC
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['player_id']]);
    $lastTask = $stmt->fetch();

    if ($lastTask && strtotime($lastTask['created_at']) > strtotime('-1 hour')) {
        $minutesLeft = 60 - floor((time() - strtotime($lastTask['created_at'])) / 60);
        $createErrors[] = "You can create another task in {$minutesLeft} minute(s).";
    } elseif ($taskTypeId === 0 || $assignedRankId === 0) {
        $createErrors[] = "Please select a task type and target rank.";
    } else {
        $validRankIds = array_column($targetRanks, 'rank_id');
        if (!in_array($assignedRankId, $validRankIds, true)) {
            $createErrors[] = "You can't assign tasks to that rank.";
        } else {
            $stmt = $pdo->prepare("SELECT mob_id FROM PLAYER WHERE player_id = ?");
            $stmt->execute([$_SESSION['player_id']]);
            $mobId = $stmt->fetchColumn();

            $stmt = $pdo->prepare("INSERT INTO TASK (task_type_id, created_by, assigned_rank_id, mob_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$taskTypeId, $_SESSION['player_id'], $assignedRankId, $mobId]);
            $newTaskId = $pdo->lastInsertId();

            $stmt = $pdo->prepare("
                INSERT INTO TASK_ASSIGNMENT (task_id, player_id, completed)
                SELECT ?, player_id, FALSE
                FROM PLAYER
                WHERE mob_id = ? AND rank_id = ?
            ");
            $stmt->execute([$newTaskId, $mobId, $assignedRankId]);

            header("Location: ?page=gameScreen&taskCreated=1");
            exit;
        }
    }
}
?>

<?php if (!empty($createErrors)): ?>
    <?php foreach ($createErrors as $error): ?>
        <p class="text-mmRed font-inter font-medium text-center"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form method="POST" class="flex flex-col gap-3">
    <select name="task_type_id" class="px-3 py-2 rounded-md font-inter border-2 border-inputGrey">
        <option value="">Select task type</option>
        <?php foreach ($taskTypes as $type): ?>
            <option value="<?= $type['task_type_id'] ?>"><?= htmlspecialchars($type['type_name']) ?></option>
        <?php endforeach; ?>
    </select>

    <select name="assigned_rank_id" class="px-3 py-2 rounded-md font-inter border-2 border-inputGrey">
        <option value="">Assign to rank</option>
        <?php foreach ($targetRanks as $rank): ?>
            <option value="<?= $rank['rank_id'] ?>"><?= htmlspecialchars($rank['rank_name']) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="create_task" class="px-3 py-2 hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover text-white font-koho font-bold rounded-lg">
        Create
    </button>
</form>