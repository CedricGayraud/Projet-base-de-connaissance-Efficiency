<?php
require './session_config.php';
require '../Class/Card.php';
require '../Class/Platform.php';
require '../Class/Thematic.php';
$thematics = Thematic::getAllThematics($bdd);
$platforms = Platform::getAllPlatforms($bdd);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Effiiciency - Créer une fiche</title>
</head>

<body>



    <div x-data="{ showConfirmation: false }" class="my-20">
        <?php include 'sidebar.php';

        if (isset($_SESSION['user'])) {

            $userId = $_SESSION['user'];

            // $connect = $bdd->prepare('SELECT * FROM users WHERE id = ' . $userId . '');
            // $connect->execute();
            // $valeur = $connect->fetchAll(PDO::FETCH_ASSOC);
        ?>
            <h1 class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-[#2CE6C1]">Créez votre fiche</h1>

            <form class="bg-slate-100 lg:w-2/4 mx-auto mt-10 p-4 rounded-xl shadow-md" action="creation_fiche_controller.php" method="post">
                <div class="lg:flex justify-center">
                    <input type="hidden" name="user" value="<?= $userId ?>">
                    <div class="lg:w-2/4 m-4">
                        <label for="cardTitle" class="block mb-2 lg:text-sm font-medium text-gray-900 dark:text-white text-3xl">Titre de la fiche</label>
                        <input type="text" name="cardTitle" class="bg-gray-50 border-2 border-[#2CE6C1] text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE] lg:h-fit h-16" required>
                    </div>
                    <div class="lg:w-2/4 m-4">
                        <label for="cardSummary" class="block mb-2 lg:text-sm font-medium text-gray-900 dark:text-white text-3xl">Résumé</label>
                        <input type="text" name="cardSummary" class="bg-gray-50 border-2 border-[#2CE6C1] text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE] lg:h-fit h-16" required>
                    </div>

                </div>
                <div class="flex lg:justify-center justify-between">
                    <div class="lg:w-2/4 m-4 w-full">
                        <label for="cardPlateforme" class="block mb-2 lg:text-sm font-medium text-gray-900 dark:text-white text-3xl">Plateformes</label>
                        <select name="cardPlateforme" autocomplete="country-name" class="block w-full rounded-md border-2 border-[#2CE6C1] p-2.5 text-gray-900 shadow-sm focus:outline-none focus:ring focus:ring-[#BAE1FE] lg:text-sm sm:leading-6 text-2xl">
                            <option selected>Sélectionner une plateforme</option>
                            <?php foreach ($platforms as $platform) : ?>
                                <option value="<?= $platform->getId(); ?>"><?php echo $platform->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="lg:w-2/4 m-4 w-full">
                        <label for="cardTheme" class="block mb-2 lg:text-sm font-medium text-gray-900 dark:text-white text-3xl">Thèmes</label>
                        <select name="cardTheme" autocomplete="country-name" class="block w-full rounded-md border-2 border-[#2CE6C1] p-2.5 text-gray-900 shadow-sm focus:outline-none focus:ring focus:ring-[#BAE1FE] lg:text-sm sm:leading-6 text-2xl">
                            <option selected>Sélectionner un Thème</option>
                            <?php foreach ($thematics as $thematic) : ?>
                                <option value="<?= $thematic->getId(); ?>"><?php echo $thematic->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="m-4">
                    <label for="" class="block mb-2 lg:text-sm font-medium text-gray-900 dark:text-white text-3xl">Content</label>
                    <textarea name="cardContent" id="cardContent" class="bg-gray-50y border-2 border-[#2CE6C1] text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div class="m-4">
                    <label for="cardGitHub" class="block mb-2 lg:text-sm font-medium text-gray-900 dark:text-white text-3xl">Script</label>
                    <input type="text" name="cardGitHub" class="bg-gray-50 border-2 border-[#2CE6C1] text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE] lg:h-fit h-16">
                    </input>
                </div>

                <!-- <div class="m-4">
                <label for="cardImg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image lien</label>
                <input type="text" name="cardImg" class="bg-gray-50 border-2 border-[#2CE6C1] text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE] lg:h-fit h-16 bg-gray-50 border-2 border-[#2CE6C1] text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </input>
            </div> -->
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



            <div class="p-5 w-[340px] h-auto left-0 top-0  bg-neutral-50 rounded-[20px] shadow m-auto mt-72">
                <div class="text-center text-black text-2xl font-normal font-['Poppins']">Vous n'êtes pas connecté</div>
                <a href="/ressources/views/login.php" class="flex justify-center mt-10 text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Se connecter</a>
            </div>

        <?php } ?>

        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

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

            document.addEventListener("DOMContentLoaded", function() {
                ClassicEditor
                    .create(document.querySelector('#cardContent'))
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>

    </div>

</body>

</html>