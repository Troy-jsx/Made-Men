<form method="POST" class="flex flex-col gap-3 sm:gap-4 md:gap-6 lg:gap-10 aspect-[600/650] h-[90%]">
    <label class='font-koho font-bold tracking-koho text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-shadow-lg/40'>Sign Up</label>

    <div class='flex flex-col md:gap-3 lg:gap-4 w-fit'>
        <div class='flex flex-col md:gap-0.5 lg:gap-1'> 
            <label class='font-koho font-bold tracking-koho md:text-3xl lg:text-4xl text-shadow-lg/40'>Email Address</label>
            <input type="email" name="email" placeholder="eg: mobster@mob.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="caret-mmRed w-full md:px-3 md:py-0.5 lg:px-4 lg:py-1 bg-transparent border-3 shadow-xl/40 border-inputGrey rounded-sm font-inter font-medium md:text-xl lg:text-3xl focus:outline-none">
        </div>

        <div class='flex flex-col md:gap-0.5 lg:gap-1'> 
            <label class='font-koho font-bold tracking-koho md:text-3xl lg:text-4xl text-shadow-lg/40'>Username</label>
            <input type="text" name="username" placeholder="eg: Joey_Torino" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" class="caret-mmRed w-full md:px-3 md:py-0.5 lg:px-4 lg:py-1 bg-transparent border-3 shadow-xl/40 border-inputGrey rounded-sm font-inter font-medium md:text-xl lg:text-3xl focus:outline-none">
        </div>

        <div class='flex flex-col md:gap-0.5 lg:gap-1'> 
            <label class='font-koho font-bold tracking-koho md:text-3xl lg:text-4xl text-shadow-lg/40'>Password</label>
            <input type="password" name="password" placeholder="******" class="caret-mmRed w-full md:px-3 md:py-0.5 lg:px-4 lg:py-1 bg-transparent border-3 shadow-xl/40 border-inputGrey rounded-sm font-inter font-medium md:text-xl lg:text-3xl focus:outline-none">
        </div>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="flex flex-col gap-1">
            <?php foreach ($errors as $error): ?>
                <p class="text-mmRed font-koho tracking-koho font-medium text-3xl"><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class='flex flex-col w-[40%] gap-0.5 sm:gap-1 md:gap-1.5 lg:gap-2'>
        <button type="submit" class="px-3 py-1 sm:text-2xl sm:px-4 sm:py-1 md:text-4xl md:px-6 md:py-1.5 lg:text-6xl lg:py-2 transition-all duration-150 ease-in-out hover:cursor-pointer bg-btn-fill-default hover:bg-btn-fill-hover shadow-2xl/33 hover:scale-102 text-white font-koho font-bold rounded-lg w-full">
            Next
        </button>

        <a href="?page=login" class=' text-xs hover:cursor-pointer hover:text-[#8239bb] text-left font-inter font-medium sm:text-xs md:text-lg lg:text-xl text-[#5300BF] underline'>Already have an account? Click Here!</a>
    </div>
</form>