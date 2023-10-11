<?php
require './session_config.php';
require '../Class/Card.php';
require '../Controller/cardController.php';

$controller = new CardController();
$cards = $controller->getFiche();
?>

<div>
    <?php include 'sidebar.php' ?>

    <h1 class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-[#2CE6C1]">Créez votre fiche</h1>

    <form class="bg-slate-100 w-2/4 mx-auto mt-20 p-4 rounded-xl">
        <div class="flex justify-center">
            <div class="w-2/4 m-4">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Titre de la fiche</label>
                <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Francis" required>
            </div>
            <div class="w-2/4 m-4">
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thèmes</label>
                <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 p-2.5 text-gray-900 shadow-sm focus:outline-none focus:ring focus:ring-[#BAE1FE] sm:max-w-xs sm:text-sm sm:leading-6">
                    <option selected>Sélectionner un Thème</option>
                    <option>theme 1</option>
                    <option>theme 2</option>
                    <option>theme 3</option>
                </select>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-2/4 m-4">
                <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plateformes</label>
                <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 p-2.5 text-gray-900 shadow-sm focus:outline-none focus:ring focus:ring-[#BAE1FE] sm:max-w-xs sm:text-sm sm:leading-6">
                    <option selected>Sélectionner une plateforme</option>
                    <option>plateforme 1</option>
                    <option>plateforme 2</option>
                    <option>plateforme 3</option>
                </select>
            </div>
            <div class="w-2/4 m-4">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Résumé</label>
                <input type="tel" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
            </div>
        </div>
        <div class="m-4">
            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
            <textarea type="password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contenu ..." required>
        </textarea>
        </div>
        <div class="flex items-start m-4">

            <label class="block mr-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Media</label>
            <div class="flex w-full items-center justify-center bg-grey-lighter">
                <label class="w-72 flex flex-col items-center px-4 py-6 bg-white text-[#BAE1FE] rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-[#BAE1FE] hover:text-white">
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                    </svg>
                    <span class="mt-2 text-base leading-normal">Ajouter un fichier</span>
                    <input type='file' class="hidden" />
                    <span class="mt-2 text-sm leading-normal text-center text-slate-500">SVG, PNG, JPG or GIF (MAX. 800x400px).</span>
                </label>
            </div>
        </div>

        <div class="flex">
            <button class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Annuler</button>
            <button type="submit" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enregistrer</button>
        </div>
    </form>

    <?php
    foreach ($cards as $card) : ?>
        <p class="text-center"> test <?php echo $card->getId(); ?></p>
    <?php endforeach; ?>

</div>