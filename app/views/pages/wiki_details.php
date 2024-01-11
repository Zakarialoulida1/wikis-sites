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

            </div>

           

        </div>
    </div>
</nav>

<?php
$wiki=$data['wiki'];
$user=$data['user'];
$category=$data['category'];
$tags=$data['tags'];


?>
 <!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6">
  <!-- Section: Design Block -->
  
  <section class="mb-32">
    <img src="<?= URLROOT .'/img/'.$wiki->wiki_picture?>"
      class="mb-6 w-[50vw] mx-auto h-[35vh] rounded-lg shadow-lg " alt="image" />

    <div class="mb-6 flex items-center">
      <img src="<?php echo URLROOT . '/img/'. $user->image ;?>" class="mr-2 h-8 rounded-full" alt="avatar"
        loading="lazy" />
      <div>
        <span> Published <u><?= $wiki->created_at ?></u> by </span>
        <a href="#!" class="font-medium"><?= $user->nom.' ' .$user->prenom ;?></a>
      </div>
      <u class='bg-blue-600 text-white p-1 rounded-md m-1'><?php echo $category ? $category->name : "general"; ?> </u>
    </div>

    <h1 class="mb-6 text-3xl font-bold">
   <?=$wiki->title ;?>
    </h1>


    <p>
   <?= $wiki->content ;?>
    </p>
    
    <div class="mt-8">
<?php foreach($tags as $tag):?>
    <span class='bg-blue-500 text-white p-1 rounded-md m-1'><?= $tag->name ;?> </span>
<?php endforeach ;?>
    </div>
  </section>
  <!-- Section: Design Block -->
</div>
<!-- Container for demo purpose -->



















<script>
    $(document).ready(function() {
   
    });
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>