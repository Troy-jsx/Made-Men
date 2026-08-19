<form class="flex flex-col gap-3 sm:gap-4 md:gap-6 lg:gap-10 aspect-600/650 h-[90%]">
    <label class='font-koho font-bold tracking-koho text-3xl sm:text-4xl md:text-5xl lg:text-7xl text-shadow-lg/40'>Log In</label>

    <div class='flex flex-col md:gap-4 lg:gap-6 w-fit'>
        <div class='flex flex-col md:gap-0.5 lg:gap-1'> 
            <label class='font-koho font-bold tracking-koho md:text-3xl lg:text-4xl text-shadow-lg/40'>Username</label>
            <input type="text" name="username" placeholder="eg: Joey_Torino" class="caret-mmRed w-full md:px-3 md:py-0.5 lg:px-4 lg:py-1 bg-transparent border-3 shadow-xl/40 border-inputGrey rounded-sm font-inter font-medium md:text-2xl lg:text-3xl focus:outline-none">
        </div>

        <div class='flex flex-col md:gap-0.5 lg:gap-1'> 
            <label class='font-koho font-bold tracking-koho md:text-3xl lg:text-4xl text-shadow-lg/40'>Password</label>
            <input type="password" name="password" placeholder="******" class="caret-mmRed w-full md:px-3 md:py-0.5 lg:px-4 lg:py-1 bg-transparent border-3 shadow-xl/40 border-inputGrey rounded-sm font-inter font-medium md:text-2xl lg:text-3xl focus:outline-none">
        </div>
    </div>

    <div class='flex flex-col gap-0.5 sm:gap-1 md:gap-2 lg:gap-3'>
        <?php
            $nextPage = '?page=midGameMobSelect';
            include "nextButton.php";
        ?>

        <a href="?page=signup" class=' text-[2px] hover:cursor-pointer hover:text-[#8239bb] text-left font-inter font-medium sm:text-xs md:text-lg lg:text-xl text-[#5300BF] underline'>Don't have an account? Click Here!</a>
    </div>

</form>