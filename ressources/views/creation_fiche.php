<?php
require './session_config.php';
require '../Class/Card.php';
require '../Class/Platform.php';
require '../Class/Thematic.php';
$thematics = Thematic::getAllThematics($bdd);
$platforms = Platform::getAllPlatforms($bdd);
?>


<div x-data="{ showConfirmation: false }" class="my-20">
    <?php include 'sidebar.php';

    if (isset($_SESSION['user'])) {

        $userId = $_SESSION['user'];

        // $connect = $bdd->prepare('SELECT * FROM users WHERE id = ' . $userId . '');
        // $connect->execute();
        // $valeur = $connect->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <h1 class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-[#2CE6C1]">Créez votre fiche</h1>

        <form class="bg-slate-100 w-2/4 mx-auto mt-10 p-4 rounded-xl" action="creation_fiche_controller.php" method="post">
            <div class="flex justify-center">
                <input type="hidden" name="user" value="<?= $userId ?>">
                <div class="w-2/4 m-4">
                    <label for="cardTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Titre de la fiche</label>
                    <input type="text" name="cardTitle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" required>
                </div>
                <div class="w-2/4 m-4">
                    <label for="cardSummary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Résumé</label>
                    <input type="text" name="cardSummary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:outline-none focus:ring focus:ring-[#BAE1FE]" required>
                </div>

            </div>
            <div class="flex justify-center">
                <div class="w-2/4 m-4">
                    <label for="cardPlateforme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plateformes</label>
                    <select name="cardPlateforme" autocomplete="country-name" class="block w-full rounded-md border-0 p-2.5 text-gray-900 shadow-sm focus:outline-none focus:ring focus:ring-[#BAE1FE] sm:max-w-xs sm:text-sm sm:leading-6">
                        <option selected>Sélectionner une plateforme</option>
                        <?php foreach ($platforms as $platform) : ?>
                            <option value="<?= $platform->getId(); ?>"><?php echo $platform->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="w-2/4 m-4">
                    <label for="cardTheme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thèmes</label>
                    <select name="cardTheme" autocomplete="country-name" class="block w-full rounded-md border-0 p-2.5 text-gray-900 shadow-sm focus:outline-none focus:ring focus:ring-[#BAE1FE] sm:max-w-xs sm:text-sm sm:leading-6">
                        <option selected>Sélectionner un Thème</option>
                        <?php foreach ($thematics as $thematic) : ?>
                            <option value="<?= $thematic->getId(); ?>"><?php echo $thematic->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <div class="m-4">
                <label for="cardContent" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                <textarea type="text" name="cardContent" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
            </div>
            <div class="m-4">
                <label for="cardGitHub" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Script</label>
                <input type="text" name="cardGitHub" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </input>
            </div>
            <!-- <div class="flex m-4">
            <label class="block mr-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Image de la fiche</label>
            <div class="ml-32 w-full items-center bg-grey-lighter">
                <label class="w-72 flex flex-col items-center px-4 py-6 bg-white text-[#BAE1FE] rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-[#BAE1FE] hover:text-white">
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                    </svg>
                    <span class="mt-2 text-base leading-normal">Ajouter un fichier</span>
                    <input type="file" id="file_input" name="cardImg" class="hidden" onchange="updateFileName()" />
                    <span id="file_name" class="mt-2 text-sm leading-normal text-center text-slate-500">SVG, JPG, JPEG, PNG ET GIF</span>
                </label>
            </div>
        </div> -->

            <div class="m-4">
                <label for="cardImg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image lien</label>
                <input type="text" name="cardImg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </input>
            </div>
            <div class="flex ml-4">
                <button class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Annuler</button>
                <button type="submit" name="create_card" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enregistrer</button>
            </div>
        </form>

        <div x-show="showConfirmation" id="confirmation-message" class="flex w-fit m-auto border-2 border-green-200">
            <p class="text-green-700 bg-green-200 p-4">'Votre fiche a bien été créée!'</p>
            <a href="decouvrir.php" class="text-green-800 bg-green-200 p-4 bg-green-200 hover:bg-white">Voir ma fiche</a>
        </div>

        <?php
        if (isset($_SESSION['confirmation_message'])) {
            echo '    <div class="flex w-fit m-auto border-2 border-green-200"><p class="text-green-700 bg-green-200 p-4">' . $_SESSION['confirmation_message'] . '</p>
            <a href="decouvrir.php" class="text-green-800 bg-green-200 p-4 bg-green-200 hover:bg-white">Voir ma fiche</a></div>';

            // Assurez-vous de vider la variable de session pour qu'elle ne s'affiche qu'une seule fois.
            unset($_SESSION['confirmation_message']);
        }
    } else {
        ?>



        <p>Vous n'êtes pas connecté</p>

    <?php } ?>

    <script>
        function updateFileName() {
            const fileInput = document.getElementById('file_input');
            const fileNameSpan = document.getElementById('file_name');
            const allowedExtensions = ['svg', '.jpg', '.jpeg', '.png', '.gif'];

            if (fileInput.files.length > 0) {
                const selectedFile = fileInput.files[0];
                const fileName = selectedFile.name;
                const fileExtension = fileName.substr(fileName.lastIndexOf('.'));

                if (allowedExtensions.includes(fileExtension.toLowerCase())) {
                    fileNameSpan.innerText = 'Fichier sélectionné : ' + fileName;
                } else {
                    fileNameSpan.innerText = 'Extension de fichier non autorisée.';
                    // Réinitialisez le champ d'entrée de fichier
                    fileInput.value = '';
                }
            } else {
                fileNameSpan.innerText = 'Aucun fichier sélectionné';
            }
        }
    </script>

</div>