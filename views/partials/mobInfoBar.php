<?php
$stmt = $pdo->prepare("
    SELECT v.vote_id, v.vote_type, v.description, v.cost, caller.username AS caller_username, caller.avatar AS caller_avatar,
    (SELECT COUNT(*) FROM VOTE_CAST WHERE vote_id = v.vote_id AND vote_value = TRUE) AS yes_count,
    (SELECT COUNT(*) FROM VOTE_CAST WHERE vote_id = v.vote_id AND vote_value = FALSE) AS no_count
    FROM VOTE v
    JOIN PLAYER caller ON caller.player_id = v.called_by
    WHERE v.mob_id = (SELECT mob_id FROM PLAYER WHERE player_id = ?) AND v.resolved = FALSE
");
$stmt->execute([$_SESSION['player_id']]);
$votes = $stmt->fetchAll();
?>

<div class='min-h-screen overflow-hidden relative'>
    <div class="bg-[url('../public/img/paperBGVertical.png')] flex-col min-h-[110vh] -rotate-3 translate-x-[-5vw] pb-[53vh] translate-y-[-20vh] drop-shadow-[0px_0px_30px_rgba(0,0,0,1)] flex align-center bg-cover bg-no-repeat absolute w-[40vw] aspect-843/1862">
        <div class="pt-[22vh] pl-[8vw] pr-[4vw] flex flex-col items-center h-full w-full">
            <div class="align-center w-full h-fit transform rotate-3 flex flex-col gap-6 min-h-0">
                <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-9xl text-mmRed text-center font-koho tracking-koho font-bold drop-shadow-lg/80">Votes</h1>

                <?php if (empty($votes)): ?>
                    <p class="font-koho text-black/70 text-center">No active votes.</p>
                <?php else: ?>
                    <?php foreach ($votes as $vote): ?>
                        <?php include __DIR__ . '/../partials/voteCard.php'; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>