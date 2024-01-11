<?php require APPROOT . '/views/inc/header.php'; ?>


<nav x-data="{ isOpen: false }" class="relative bg-white shadow dark:bg-gray-800">
    <div class="container px-6 py-3 mx-auto md:flex">
        <div class="flex items-center justify-between">
            <a href="#">
                <img class="w-auto h-12 w-8 " src="<?php echo URLROOT; ?>/img/logo.png" alt="">
            </a>

            <!-- Mobile menu button -->
            <div class="flex lg:hidden">
                <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                    <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>

                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white dark:bg-gray-800 md:mt-0 md:p-0 md:top-0 md:relative md:opacity-100 md:translate-x-0 md:flex md:items-center md:justify-between">
            <div class="flex flex-col px-2 -mx-4 md:flex-row md:mx-10 md:py-0">
                <a href="<?= URLROOT; ?>/pages/index" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Home</a>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin') : ?>
                    <a href="<?= URLROOT; ?>/tags/index" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">TAGS</a>
                    <a href="<?= URLROOT; ?>/categories/index" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Categorys</a>
                <?php endif ?>
                <a id="create_wiki" href="<?= URLROOT; ?>/wikis/formWiki" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Create a wiki</a>
            </div>

           
                <div class="relative  flex gap-4 items-center justify-between mt-4 md:mt-0">
                    <div class="w-[35vw]">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>

                        <input type="text" id="default-search" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300" placeholder="Search">
                    </div>
                    <?php if (isset($_SESSION['user_role'])) { ?>

                        <a href="<?php echo URLROOT; ?>/users/logout" class="p-4 w-fit h-fit text-center text-black text-xs font-medium bg-red-400 rounded-full">LOG OUT</a>
                    <?php } else { ?>
                        <div class="relative mt-4 md:mt-0">
                            <a href="<?php echo URLROOT; ?>/users/login" class="p-[8px] w-fit h-fit text-center text-[#1062d4] text-md font-medium bg-white rounded-full">Login</a>
                            <a href="<?php echo URLROOT; ?>/users/register" class="p-[8px] w-fit h-fit text-center text-white text-md font-medium  bg-[#1062d4] rounded hover:bg-white hover:text-black">SignUp</a>

                        </div> <?php } ?>
                </div>
           
        </div>
</nav>

<main id="wikis" class=" bg-gray-200 p-2 grid grid-cols-1 gap-5  ">

    <?php foreach ($data['wikis'] as $wiki) : ?>
        <section class="text-blueGray-700 bg-white ">
            <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row md:justify-around ">
                <div class="w-full lg:w-1/3 lg:max-w-lg md:w-1/2">
                    <img class="object-cover object-center rounded-lg " alt="hero" src="<?= URLROOT . '/img/' . $wiki->wiki_picture; ?>">
                </div>
                <div class="flex flex-col items-start mb-16 text-left  md:w-1/3  ">

                    <h1 class="mb-8 text-2xl font-black tracking-tighter text-black md:text-5xl title-font"> <?php echo $wiki->title; ?> </h1>
                    <p class="mb-8 text-base leading-relaxed text-left text-blueGray-600 max-h-[25vh] overflow-y-hidden "> <?php echo $wiki->content; ?> </p>
                    <div class="flex flex-col justify-center lg:flex-row">
                        <a href="<?= URLROOT . '/wikis/read_more/' . $wiki->wiki_id; ?>" class="flex items-center px-6 py-2 mt-auto font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-lg hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2"> Show me </a>
                        <p class="mt-2 text-sm text-left text-blueGray-600 md:ml-6 md:mt-0"> It will take you to read more <br class="hidden lg:block">
                            <a href="<?= URLROOT . '/wikis/read_more/' . $wiki->wiki_id; ?>" class="inline-flex items-center font-semibold text-blue-600 md:mb-2 lg:mb-0 hover:text-black " title="read more"> Read more about it » </a>
                        </p>


                    </div>
                    <div class="flex w-full mt-16  justify-around ">
                        <a href="<?= URLROOT . '/wikis/archiver_wiki/' . $wiki->wiki_id; ?>" class="p-2 bg-red-400  rounded cursor-pointer "><i class="fa-solid fa-box-archive "> ARCHIVER</i></a>
                        <a href="<?= URLROOT . '/wikis/update_wiki/' . $wiki->wiki_id; ?>" class="p-2 bg-green-400 rounded cursor-pointer "><i class="fa-regular fa-pen-to-square "> UPDATE</i></a>
                    </div>
                </div>


            </div>
        </section>
    <?php endforeach; ?>


</main>


<main id="search_result" class=" bg-gray-200 p-2 grid grid-cols-1 gap-5  ">
</main>


<div class="w-full h-fit   px-4 py-4 my-4 bg-white rounded-lg shadow-lg bg-gray-800">


    <!-- Create wiki Card -->
    <div class="my-1 px-1 w-full h-full  ">

        <!-- Article -->
        <article class="w-full h-full overflow-hidden rounded-lg shadow-xl">
            <div class="group bg-gray-300  w-full h-full  py-16 px-4 flex flex-col space-y-2 items-center cursor-pointer rounded-md ">
                <a data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="bg-gray-200 text-yellow-700 group-hover:text-gray-800 group-hover:smooth-hover flex w-20 h-20 rounded-full items-center justify-center" href="<?= URLROOT; ?>/wikis/formWiki">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </a>
                <a class="text-gray-600 group-hover:text-gray-800 group-hover:smooth-hover text-center" href="#"><button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button">
                        Create wiki </button> </a>
            </div>
        </article>
        <!-- END Article -->

    </div>
    <!-- END Column -->

</div>








<script>
    $("#default-search").keyup(function() {
        var input = $(this).val();
        console.log("bgggggg");


        if (input != "") {
            // alert(input);
            const fetchUrl = "<?php echo URLROOT . '/wikis/search_wiki'; ?>";
            $.ajax({
                url: fetchUrl,
                method: "POST",
                data: {

                    input: input
                },
                // dataType: 'json',
                success: function(tasks) {
                    console.log(tasks);
                    $("#search_result").html(tasks);


                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tasks:', status, error);
                }
            });
            $("#wikis").hide();
            $("#search_result").show()

        } else {
            $("#wikis").show();
            $("#search_result").hide()

        }

    })
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>