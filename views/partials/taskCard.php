<div class="group border-black flex flex-col border-4 gap-5 sm:px-4 px-2 py-1 sm:py-2 md:px-6 md:py-3 lg:px-8 lg:pt-6 rounded-xl cursor-default select-none">
    <div class="flex flex-row gap-2 lg:gap-6 items-center justify-center">
        <div style="background-image: url('../public/img/avatars/<?= htmlspecialchars($task['giver_avatar'] ?? 'oldDude.png') ?>')" class="bg-cover w-[30%] aspect-square rounded-md border-border-brown border-4">

        </div>
        <div class="w-[60%] flex flex-col sm:gap-3 lg:gap-2 justify-center h-full">
            <div class="flex flex-col text-left justify-between">
                <h1 class="font-koho tracking-koho font-medium text-md sm:text-lg md:text-xl lg:text-2xl drop-shadow-lg/20 text-gray-800 underline text-left w-full"><?= htmlspecialchars($task['giver_username'] ?? 'The Family') ?></h1>
                <div class="flex flex-row justify-between w-full">
                    <h1 class="font-koho tracking-koho font-bold text-2xl sm:text-2xl md:text-2xl lg:text-3xl drop-shadow-lg/20 text-black text-left w-full"><?= htmlspecialchars($task['type_name']) ?></h1>
                    <h1 class="text-koho text-money-green font-bold tracking-koho text-4xl">$<?= (int)$task['base_reward'] ?></h1>
                </div>
            </div>
            <div class="flex flex-row justify-between">
                <h1 class="font-inter tracking-koho font-medium text-md sm:text-md md:text-lg lg:text-xl drop-shadow-md/20 text-black/90 text-left w-full"><?= htmlspecialchars($task['description'] ?? '') ?></h1>
            </div>
        </div>
    </div>
    <div class="max-h-0 overflow-hidden flex flex-row hover:gap-4 group-hover:max-h-100 transition-all ease-in-out duration-350">
        <form method="POST" class="w-full">
            <input type="hidden" name="assignment_id" value="<?= $task['assignment_id'] ?>">
            <button type="submit" name="accept_task" class='w-full px-3 py-1 sm:text-xl sm:px-2 sm:py-1 md:text-3xl md:px-6 md:py-1 lg:text-4xl lg:py-1  transition-all duration-150 ease-in-out hover:cursor-pointer bg-money-green hover:bg-money-green-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg'>
                Accept
            </button>
        </form>
    </div>
</div>