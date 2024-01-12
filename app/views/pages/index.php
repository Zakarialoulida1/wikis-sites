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
                    <a id="create_wiki" href="<?= URLROOT; ?>/wikis/stats" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Stats</a>
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




<div id="wikis" class="bg-gray-200 font-[sans-serif] p-4">
    <div class="max-w-6xl max-md:max-w-lg mx-auto">
        <div>
            <h2 class="text-3xl font-extrabold text-[#333] inline-block">LATEST BLOGS</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">

            <?php foreach ($data['wikis'] as $wiki) : ?>

                <div class="flex max-lg:flex-col bg-white  cursor-pointer rounded-md overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] hover:scale-105 transition-all duration-300">
                    <img src="<?= URLROOT . '/img/' . $wiki->wiki_picture; ?>" alt="Blog Post 2" class="lg:w-1/3 min-h-[250px] h-full object-cover" />
                    <div class="p-6 lg:w-3/5">
                        <h3 class="text-xl font-bold text-[#333]"><?php echo $wiki->title; ?></h3>
                        <span class="text-sm block text-gray-400 mt-2"><?php echo $wiki->created_at . '| by ' . $wiki->nom . ' ' . $wiki->prenom; ?> </span>
                        <p class="text-sm max-h-[15vh] overflow-y-hidden mt-4"><?php echo $wiki->content; ?></p>
                        <a href="<?= URLROOT . '/wikis/read_more/' . $wiki->wiki_id; ?>" class="mt-4 inline-block text-blue-600 text-sm hover:underline">Read More</a>
                        <?php if (!empty($wiki->tag_names)) : ?>
                            <div class="flex  flex-wrap gap-2 mt-4">
                                <?php
                                $tags = explode(",", $wiki->tag_names);
                                foreach ($tags as $tag) : ?>
                                    <span class="bg-gray-300 p-2 rounded"><?= $tag; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="flex w-full mt-16  justify-around ">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') : ?>
                                <a href="<?= URLROOT . '/wikis/archiver_wiki/' . $wiki->wiki_id; ?>" class="p-2  m-2 bg-red-400  rounded cursor-pointer "><i class="fa-solid fa-box-archive "> ARCHIVER</i></a>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])  && $wiki->user_id == $_SESSION['user_id']) : ?>
                                <a href="<?= URLROOT . '/wikis/delete_wiki/' . $wiki->wiki_id; ?>" class="p-2 m-2 bg-red-400  rounded cursor-pointer "><i class="fa-solid fa-box-archive "> DELETE</i></a>
                                <a href="<?= URLROOT . '/wikis/update_wiki/' . $wiki->wiki_id; ?>" class="p-2 m-2 bg-green-400 rounded cursor-pointer "><i class="fa-regular fa-pen-to-square "> UPDATE</i></a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
            <article class=" overflow-hidden rounded-lg shadow-xl">
                <div class="group bg-gray-300    py-16 px-4 flex flex-col space-y-2 items-center cursor-pointer rounded-md ">
                    <a data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="bg-gray-200 text-yellow-700 group-hover:text-gray-800 group-hover:smooth-hover flex w-20 h-20 rounded-full items-center justify-center" href="<?= URLROOT; ?>/wikis/formWiki">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </a>
                    <a class="text-gray-600 group-hover:text-gray-800 group-hover:smooth-hover text-center" href="#"><button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button">
                            Create wiki </button> </a>
                </div>
            </article>
        </div>
    </div>
</div>


<div class="bg-gray-200 font-[sans-serif] p-4">
    <div class="max-w-6xl max-md:max-w-lg mx-auto">

        <div id="search_result" class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
        </div>
    </div>

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