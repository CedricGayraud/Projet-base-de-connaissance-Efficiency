<?php


require '../Class/Comment.php';
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
    <link rel="stylesheet" href="/path/to/your/generated/css/tailwind.css">

</head>

<body>
    <?php

    $sessionUser = User::getSessionUser($bdd);
    $card = Card::getCardById($id_card);
    $likes = CardLike::getAllLikesByCardId($id_card);


    $comments = Comment::getAllCommentsByCardId($id_card);
    if (isset($_SESSION['user'])) {
        $sessionUserId = $sessionUser->getId();
        $isLiked = CardLike::isLiked($id_card, $sessionUserId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
            // Récupérez les données du formulaire
            $content = $_POST['content'];

            // Créez le commentaire en utilisant $content
            Comment::commentCreate($content, $sessionUserId, $id_card);
        }
    }

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
            <form class="mt-4 text-center" action="../Controller/commentController.php" method="post">
                <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                <input type="hidden" name="user_id" value="<?php echo $sessionUserId; ?>">
                <button name="likeCard" class="inline-flex items-center h-10 px-5 text-indigo-100 transition-colors duration-150 <?php echo $isLiked ? 'bg-red-500 hover:bg-red-300' : 'bg-gray-300 hover:bg-gray-100'; ?> rounded-lg focus:shadow-outline  type=" submit"">
                    <svg class="w-4 h-4 mr-3 fill-current" viewBox="0 0 20 20">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <span><?php echo $likes ?></span>
                </button>

            </form>
            <div class="mt-4 text-center">
                <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
                    <div class="max-w-2xl mx-auto px-4">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion (20)</h2>
                        </div>
                        <form action="../Controller/commentController.php" method="post">
                            <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                            <input type="hidden" name="user_id" value="<?php echo $sessionUserId; ?>">
                            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <label for="comment" class="sr-only">Votre commentaire</label>
                                <textarea name="content" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Écrire un commentaire..." required></textarea>
                            </div>
                            <button type="submit" name="create_Comment" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover-bg-primary-800">
                                Envoyer
                            </button>
                        </form>








                    </div>
                    </article>
            </div>
            </section>
    </div>
<?php }
        foreach ($comments as $comment) : ?>
    <div class="mt-4 text-center">
        <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
            <div class="max-w-2xl mx-auto px-4">
                <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img class="mr-2 w-6 h-6 rounded-full" src="<?= $comment->getUser()->getProfilPicture(); ?>" alt="Michael Gough"><?= $comment->getUser()->getNickname(); ?></p>
                            <p class="text-sm text-gray-600 dark:text-gray-400"><?= $comment->getCreatedDate(); ?></p>
                        </div>
                    </footer>
                    <p class="text-gray-500 dark:text-gray-400"><?= $comment->getContent(); ?></p>
                </article>
            </div>
        </section>
    </div>
<?php endforeach; ?>
</div>
</body>

</html>