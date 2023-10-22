<?php

require '../Class/CardLike.php';
require './session_config.php';

$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
$id_card = $_GET['fiche'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $sessionUser = User::getSessionUser($bdd);
    $card = Card::getCardById($id_card);
    $likes = CardLike::getAllLikesByCardId($id_card);
    $sessionUserId = $sessionUser->getId();
    $isLiked = CardLike::isLiked($id_card, $sessionUserId);
    $createLike = CardLike::likeCard($id_card, $sessionUserId);

    ?>
    <?php include 'sidebar.php' ?>
    <div class="md:ml-28 md:mr-8">
        <div class="flex justify-center mt-10">
            <h1 class="text-2xl font-bold"><?php echo $card->getTitle() ?></h1>
        </div>
        <div class="text-center mt-4">
            <p class="text-lg font-semibold"><?php echo $card->getUser()->getNickname() ?></p>
            <p class="text-lg"><?= formatDate($card->getCreatedDate()); ?></p>
        </div>
        <div class="flex justify-center mt-4">

            <img src=" <?php echo $card->getImg() ?>" class="w-96  max-w-full" />

        </div>
        <div class="mt-8 text-center">
            <p class="text-lg"><?php echo $card->getContentText() ?></p>
            <p class="text-lg"><?php echo $card->getGitHub() ?></p>
        </div>
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <div class="mt-4 text-center">
                <button x-on:click="<?php $createLike ?>" class="inline-flex items-center h-10 px-5 text-indigo-100 transition-colors duration-150 
                        <?php echo $isLiked ? 'bg-red-500 hover:bg-red-300' : 'bg-gray-300 hover:bg-gray-100'; ?> 
                                        rounded-lg focus:shadow-outline">
                    <svg class="w-4 h-4 mr-3 fill-current" viewBox="0 0 20 20">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <span><?php echo $likes ?></span>
                </button>

            </div>
            <div class="mt-4 text-center">
                <h2 class="text-lg font-semibold">Commentaires</h2>
                <div class="mt-2">
                    <textarea class="w-full h-24 px-3 py-2 border rounded-md" placeholder="Écrivez votre commentaire ici..."></textarea>
                </div>
            </div>
        <?php }
        ?>
    </div>
</body>

</html>