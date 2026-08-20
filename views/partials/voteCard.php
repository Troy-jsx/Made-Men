<div class="group border-black flex flex-col border-4 gap-5 sm:px-4 px-2 py-1 sm:py-2 md:px-6 md:py-3 lg:px-8 lg:py-4 rounded-xl cursor-default select-none">
    <div class="flex flex-row gap-2 lg:gap-6 items-center justify-center">
        <div style="background-image: url('../public/img/avatars/<?= htmlspecialchars($vote['caller_avatar'] ?? 'oldDude.png') ?>')" class="bg-cover w-[30%] aspect-square rounded-md border-border-brown border-4">

        </div>
        <div class="w-[60%] flex flex-col sm:gap-3 lg:gap-2 justify-center h-full">
            <div class="flex flex-col text-left justify-between">
                <h1 class="font-koho tracking-koho font-medium text-md sm:text-lg md:text-xl lg:text-2xl drop-shadow-lg/20 text-gray-800 underline text-left w-full"><?= htmlspecialchars($vote['caller_username']) ?></h1>
                <div class="flex flex-row justify-between w-full">
                    <h1 class="font-koho tracking-koho font-bold text-2xl sm:text-2xl md:text-3xl lg:text-4xl drop-shadow-lg/20 text-black text-left w-full"><?= htmlspecialchars($vote['vote_type']) ?></h1>
                    <?php if (!empty($vote['cost'])): ?>
                        <h1 class="text-koho text-money-green font-bold tracking-koho text-4xl">$<?= (int)$vote['cost'] ?></h1>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex flex-row justify-between">
                <h1 class="font-inter tracking-koho font-medium text-md sm:text-md md:text-lg lg:text-xl drop-shadow-md/20 text-black/90 text-left w-full"><?= htmlspecialchars($vote['description']) ?></h1>
            </div>
            <div class="flex flex-row justify-between">
                <h1 class="font-inter tracking-koho font-medium text-sm text-black/70 text-left w-full">Yes: <?= (int)$vote['yes_count'] ?> · No: <?= (int)$vote['no_count'] ?></h1>
            </div>
        </div>
    </div>
    <div class="max-h-0 overflow-hidden flex flex-row gap-4 group-hover:max-h-100 transition-all ease-in-out duration-350">
        <form method="POST" class="w-full">
            <input type="hidden" name="vote_id" value="<?= $vote['vote_id'] ?>">
            <button type="submit" name="cast_vote" value="yes" class=' w-full px-3 py-1 sm:text-xl sm:px-2 sm:py-1 md:text-3xl md:px-6 md:py-1 lg:text-4xl lg:py-1 transition-all duration-150 ease-in-out hover:cursor-pointer bg-money-green hover:bg-money-green-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg'>
                Accept
            </button>
        </form>
        <form method="POST" class="w-full">
            <input type="hidden" name="vote_id" value="<?= $vote['vote_id'] ?>">
            <button type="submit" name="cast_vote" value="no" class=' w-full px-3 py-1 sm:text-xl sm:px-2 sm:py-1 md:text-3xl md:px-6 md:py-1 lg:text-4xl lg:py-1 transition-all duration-150 ease-in-out hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg'>
                Decline
            </button>
        </form>
    </div>
</div>