<?php
$stmt = $pdo->prepare("
    SELECT tt.description, ta.assignment_id, tt.type_name, tt.base_reward, giver.username AS giver_username, giver.avatar AS giver_avatar
    FROM TASK_ASSIGNMENT ta
    JOIN TASK t ON t.task_id = ta.task_id
    JOIN TASK_TYPE tt ON tt.task_type_id = t.task_type_id
    LEFT JOIN PLAYER giver ON giver.player_id = t.created_by
    WHERE ta.player_id = ? AND ta.completed = FALSE
");
$stmt->execute([$_SESSION['player_id']]);
$tasks = $stmt->fetchAll();
?>

<div class="flex flex-col gap-4">
    <?php if (empty($tasks)): ?>
        <p class="font-koho text-2xl text-black/70 text-center">No tasks right now.</p>
    <?php else: ?>
        <?php foreach ($tasks as $task): ?>
            <?php include __DIR__ . '/taskCard.php'; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>