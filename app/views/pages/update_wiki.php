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
    <form method="post" action="<?= URLROOT . '/wikis/update_wiki/' . $data['wiki']->wiki_id ?>" class="space-y-6 border h-fit p-4 rounded border-black">


        <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <!-- ... Existing code ... -->
            <div class="col-span-full">
                <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Product Photo</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <div class="text-center">
                        
                        <input type="file" name="wiki_picture" value="">
                        <?php echo $data['wiki']->wiki_picture; ?>
                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full">
            <label class="block uppercase tracking-wide text-black text-lg font-bold mb-2" for="grid-state">
                Choose categories
            </label>
            <div class="relative">
                <select name="categorie" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required id="grid-state">
                    <option value="" selected>Sélectionnez de nouveau une catégorie</option>
                    <?php foreach ($data['categories'] as $categorie) : ?>
                        <option value="<?= $categorie->category_id; ?>" <?php echo ($categorie->category_id == $data['category']->category_id) ?  : ''; ?>>
                            <?= $categorie->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>



        <!-- ... Existing code ... -->



        <!-- ... Existing code ... -->

        <!-- Ajoutez ces lignes à votre formulaire -->
        <input type="hidden" id="selected-tag-id" name="selected_tag_id" value="">
        <div id="selected-tag-names">

        </div>


        <div>
            <label class="block uppercase tracking-wide text-black text-lg font-bold mb-2" for="grid-state-tags">
                Choose your Tags
            </label>
            <div class="relative">
                <select name="tagname" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state-tags">
                    <option value=""selected>Sélectionnez de nouveaux des tag</option>
                    <?php foreach ($data['tags'] as $tag) : ?>
                        <option value="<?= $tag->tag_id; ?>" >
                            <?= $tag->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- ... Existing code ... -->
        <div>
            <label class="text-sm">Titre</label>
            <input type="titre" name="titre" class="w-full p-3 border rounded border-black dark:bg-gray-800" value="<?php echo $data['wiki']->title; ?>">
        </div>
        <div>
            <label for="message" class="text-sm">DESCRIPTION</label>
            <textarea id="message" name="message" rows="3" class="w-full p-3 border rounded border-black dark:bg-gray-800"><?php echo $data['wiki']->content; ?></textarea>
        </div>
        <button type="submit" class="w-full text-sm font-bold uppercase rounded dark:bg-violet-400 dark:text-gray-900">update your wiki</button>
    </form>

    </form>
</div>


<script>
    /************************* */


    //************************************* */

    document.addEventListener("DOMContentLoaded", function() {
        var selectedTagIds = [];



        function updateDisplayedTags() {
            var tagsContainer = document.getElementById("selected-tag-names");
            var selectedTagIdInput = document.getElementById("selected-tag-id");
            tagsContainer.innerHTML = "";

            selectedTagIds.forEach(function(tagId) {
                var tagName = getTagNameById(tagId); // Fonction pour récupérer le nom du tag
                var tag = document.createElement("span");
                tag.className = "selected-tag";
                tag.innerHTML = "<span class='bg-blue-500 text-white p-1 rounded-md m-1'>" + tagName + "</span><button class='text-red-500' data-tag-id=\"" + tagId + "\">Remove</button>";
                tagsContainer.appendChild(tag);

                // Attach the click event to the Remove button
                var removeButton = tag.querySelector("button");
                removeButton.addEventListener("click", removeTag);
            });

            selectedTagIdInput.value = JSON.stringify(selectedTagIds);
        }

        function getTagNameById(tagId) {
            // Fonction pour récupérer le nom du tag à partir du tableau de données des tags
            var tag = <?php echo json_encode($data['tags']); ?>;
            for (var i = 0; i < tag.length; i++) {
                if (tag[i].tag_id == tagId) {
                    return tag[i].name;
                }
            }
            return "";
        }

        function removeTag(event) {
            var tagId = event.target.dataset.tagId;
            var index = selectedTagIds.indexOf(tagId);
            if (index !== -1) {
                selectedTagIds.splice(index, 1);
                updateDisplayedTags();
            }
        }

        // Event listener for the select element
        var selectElement = document.getElementById("grid-state-tags");
        selectElement.addEventListener("change", function() {
            var selectedTagId = selectElement.value;
            if (selectedTagId && !selectedTagIds.includes(selectedTagId)) {
                selectedTagIds.push(selectedTagId);
                updateDisplayedTags();
            }
        });
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>