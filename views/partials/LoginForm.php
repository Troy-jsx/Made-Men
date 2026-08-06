<form class="flex flex-col gap-10 absolute aspect-[600/650] h-[700px]">
    <label class='font-koho font-bold tracking-koho text-7xl text-shadow-lg/40'>Log In</label>

    <div class='flex flex-col gap-6 w-fit'>
        <div class='flex flex-col gap-1'> 
            <label class='font-koho font-bold tracking-koho text-4xl text-shadow-lg/40'>Username</label>
            <input type="text" name="username" placeholder="eg: Joey_Torino" class="caret-mmRed w-full px-4 py-1 bg-transparent border-3 shadow-xl/40 border-inputGrey rounded-sm font-inter font-medium text-3xl focus:outline-none">
        </div>

        <div class='flex flex-col gap-1'> 
            <label class='font-koho font-bold tracking-koho text-4xl text-shadow-lg/40'>Password</label>
            <input type="password" name="password" placeholder="******" class="caret-mmRed w-full px-4 py-1 bg-transparent border-3 shadow-xl/40 border-inputGrey rounded-sm font-inter font-medium text-3xl focus:outline-none">
        </div>
    </div>

    <div class='flex flex-col gap-3'>
        <?php
            $nextPage = '?page=signup';
            include "nextButton.php";
        ?>

        <a href="?page=signup" class='hover:cursor-pointer text-left font-inter font-medium text-xl text-[#5300BF] underline'>Don't have an account? Click Here!</a>
    </div>

</form>