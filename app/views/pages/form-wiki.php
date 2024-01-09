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
                <a href="#" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">About</a>
                <a href="#" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Contact</a>
                <a id="create_wiki" href="<?= URLROOT; ?>/wikis/formWiki" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 md:mx-2">Create a wiki</a>
            </div>


        </div>
    </div>
</nav>
<div id="formWiki" class=" lg:mt-16 grid max-w-screen-xl grid-cols-1 gap-8 px-8 py-16 mx-auto rounded-lg md:grid-cols-2 md:px-12 lg:px-16 xl:px-32 items-center">
    <div class="flex flex-col justify-between">
        <div class="space-y-2">
            <h2 class="text-4xl font-bold leadi lg:text-5xl">Let's share knowledge!</h2>
            <div class="dark:text-gray-400">Vivamus in nisl metus? Phasellus.</div>
        </div>
        <img src="<?= URLROOT; ?>/img/doodle.svg" alt="" class="p-6 h-52 md:h-64">
    </div>
    <form method="post" action="<?= URLROOT; ?>/wikis/formWiki" class="space-y-6 border h-fit p-4 rounded border-black">


        <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

            <div class="col-span-full">
                <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Product Photo</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                        </svg>
                      
                        <input type="file" name="wiki_picture" class="<?php echo (!empty($data['wiki_picture_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wiki_picture']; ?>">
                        <span class="invalid-feedback text-red-500"><?php echo $data['wiki_picture_err']; ?></span>
                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="w-full ">
            <label class="block uppercase tracking-wide text-black text-lg font-bold mb-2" for="grid-state">
                choose categories
            </label>
            <div class="relative">
                <select name="categorie" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">

                    <?php foreach ($data['categories'] as $categorie) : ?>

                        <option value="<?= $categorie->category_id; ?>"><?= $categorie->name; ?> </option>


                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>



        <div>
            <label class="block uppercase tracking-wide text-black text-lg font-bold mb-2" for="grid-state-tags">
                Choose your Tags
            </label>
            <div class="relative">
                <select name="tagname" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state-tags">
                    <?php foreach ($data['tags'] as $tag) : ?>
                        <option value="<?= $tag->name; ?>"><?= $tag->name; ?> </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Container to display selected tags -->
        <div id="selected-tags" name="selected-tags"></div>
        <input type="hidden" id="selected-tags-input" name="selected_tags" value="<?= htmlspecialchars(json_encode($data['selected_tags'])); ?>">




        <div>
            <label  class="text-sm">Titre</label>
            <input type="titre" name="titre" class="w-full p-3 border rounded border-black dark:bg-gray-800">
        </div>
        <div>
            <label for="message" class="text-sm">DESCRIPTION</label>
            <textarea id="message" name="message" rows="3" class="w-full p-3 border rounded border-black dark:bg-gray-800"></textarea>
        </div>
        <button type="submit" class="w-full  text-sm font-bold  uppercase rounded dark:bg-violet-400 dark:text-gray-900">create your wiki</button>
    </form>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        var selectedTags = [];


        function updateDisplayedTags() {
            var tagsContainer = document.getElementById("selected-tags");
            var selectedTagsInput = document.getElementById("selected-tags-input");
            tagsContainer.innerHTML = "";


            selectedTags.forEach(function(tagId) {
                var tag = document.createElement("span");
                tag.className = "selected-tag";
                tag.innerHTML = "<span class='bg-blue-500 text-white p-1 rounded-md m-1' >" + tagId + "</span><button class='text-red-500' data-tag-id=\"" + tagId + "\">Remove</button>";
                tagsContainer.appendChild(tag);

                // Attach the click event to the Remove button
                var removeButton = tag.querySelector("button");
                removeButton.addEventListener("click", removeTag);
            });

            selectedTagsInput.value = JSON.stringify(selectedTags);

        }


        function removeTag(event) {
            var tagId = event.target.dataset.tagId;
            var index = selectedTags.indexOf(tagId);
            if (index !== -1) {
                selectedTags.splice(index, 1);
                updateDisplayedTags();
            }
        }
        


        // Event listener for the select element
        var selectElement = document.getElementById("grid-state-tags");
        selectElement.addEventListener("change", function() {
            var selectedTagId = selectElement.value;
            if (selectedTagId && !selectedTags.includes(selectedTagId)) {
                selectedTags.push(selectedTagId);
                updateDisplayedTags();
            }
        });
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>