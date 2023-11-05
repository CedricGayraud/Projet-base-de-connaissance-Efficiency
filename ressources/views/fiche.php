<?php


require '../Class/Comment.php';
require './session_config.php';

$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
$id_card = $_GET['fiche'];

$card = Card::getCardById($id_card);
$likes = CardLike::getAllLikesByCardId($id_card);
$comments = Comment::getAllCommentsByCardId($id_card);
if (isset($_SESSION['user'])) {
    $sessionUser = User::getSessionUser($bdd);
    $sessionUserId = $sessionUser->getId();
    $isLiked = CardLike::isLiked($id_card, $sessionUserId);
}
$countComments = Comment::countCommentsByCardId($id_card);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efficiency - <?php echo $card->getTitle() ?></title>
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
</head>

<body class="bg-gray-100">
    <?php include 'sidebar.php' ?>
    <div class="md:ml-28 md:mr-8">
        <div class="flex justify-center mt-10">
            <h1 class="text-2xl font-bold"><?php echo $card->getTitle() ?></h1>
        </div>
        <div class="text-center mt-4">
            <a class="flex justify-center mt-4" href="../views/profil.php">
                <img class="h-10 w-10 rounded-full bg-gray-50 mr-3" src="<?= $card->getUser()->getProfilPicture(); ?>" alt="">

                <p class="text-xl"><?= $card->getUser()->getNickname(); ?></p>
            </a>
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
            <?php foreach ($comments as $comment) : ?>
                <div class="max-w-2xl mx-auto px-4 mt-4">
                    <article class="p-6 text-base bg-white rounded-lg shadow-lg dark:bg-gray-900">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img class="mr-2 w-6 h-6 rounded-full" src="<?= $comment->getUser()->getProfilPicture(); ?>" alt="Michael Gough"><?= $comment->getUser()->getNickname(); ?></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Le <?= formatDateDay($comment->getCreatedDate()); ?></p>
                            </div>
                        </footer>
                        <p class="text-gray-500 dark:text-gray-400"><?= $comment->getContent(); ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
            <div class="mt-2 text-center">
                <section class="dark:bg-gray-900 py-8 lg:py-8 antialiased">
                    <div class="max-w-2xl mx-auto px-4">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion (<?php echo $countComments ?>)</h2>
                        </div>
                        <form action="../Controller/commentController.php" method="post">
                            <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                            <input type="hidden" name="user_id" value="<?php echo $sessionUserId; ?>">
                            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <label for="comment" class="sr-only">Votre commentaire</label>
                                <textarea name="content" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Écrire un commentaire..." required></textarea>
                            </div>
                            <button type="submit" name="create_Comment" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Envoyer
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        <?php } ?>
    </div>
    </div>
</body>

<?php include('../views/footer.php'); ?>

</html>