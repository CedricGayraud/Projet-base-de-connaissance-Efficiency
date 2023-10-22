<?php
require './session_config.php';
include('./sidebar.php');
?>

<div>

    <form class="bg-slate-100 w-2/4 mx-auto mt-20 p-4 rounded-xl" action="dashboard_controller.php" method="post">
        <div class="justify-cente w-2/4r">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Titre de la thématique</label>
                <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre thématique" required>
            </div>
            <div class="mt-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea type="text" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre description" required></textarea>
            </div>
            <div class="mt-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Couleur en héxadécimal</label>
                <input type="text" name="color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre couleur (#BAE1FE)" required>
            </div>
        </div>
        <div class="flex mt-4">
            <button type="submit" name="create_thematic" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enregistrer</button>
        </div>
    </form>

</div>