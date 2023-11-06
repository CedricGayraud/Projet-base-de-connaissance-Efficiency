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
    <style>
        img {
            width: 60%;
            object-fit: contain;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            font-size: 28px !important;
        }

        h2 {
            font-size: 24px !important;
        }

        h3 {
            font-size: 20px !important;
        }
    </style>
</head>

<body class="bg-gray-100">
    <?php include 'sidebar.php' ?>
    <div class="bg-opacity-50 bg-[#2CE6C1] py-8 mx-auto m-auto mt-5 mb-5 rounded-lg w-4/5 flex items-center justify-center">
        <div class="md:w-1/2 pr-4 flex items-center">
            <div class="text-center">
                <p class="text-3xl font-bold"><?php echo $card->getTitle() ?></p>
                <a class="flex mt-4 justify-center" href="../views/profil.php">
                    <img class="h-10 w-10 rounded-full bg-gray-50 mr-3 ml-1" src="<?= $card->getUser()->getProfilPicture(); ?>" alt="">
                    <p class="text-xl"><?= $card->getUser()->getNickname(); ?></p>
                </a>
                <p class="text-lg mt-2"><?= formatDate($card->getCreatedDate()); ?></p>
                <form class="mt-4" action="../Controller/commentController.php" method="post">
                    <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <input type="hidden" name="user_id" value="<?php echo $sessionUserId; ?>">
                        <button name="likeCard" class="inline-flex items-center h-10 px-5 text-indigo-100 transition-colors duration-150 <?php echo $isLiked ? 'bg-red-500 hover:bg-red-300' : 'bg-gray-300 text-white hover:bg-gray-200 text-gray-300'; ?> rounded-lg focus:shadow-outline">
                            <svg class="w-4 h-4 mr-3 fill-current" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                            <span><?php echo $likes ?></span>
                        </button>
                    <?php } else { ?>
                        <button disabled name="likeCard" class="inline-flex items-center h-10 px-5 text-indigo-100 transition-colors duration-150 bg-gray-300 text-white hover:bg-gray-200 text-gray-300'; ?> rounded-lg focus:shadow-outline">
                            <svg class="w-4 h-4 mr-3 fill-current" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                            <span><?php echo $likes ?></span>
                        </button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>


    <div class="md:ml-28 md:mr-8">
        <div class="p-6 text-base bg-white rounded-lg shadow-lg dark:bg-gray-900 w-4/5 m-auto mb-6">
            <form action="../Controller/commentController.php" method="post">
                <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                <!-- Utilisez un champ de formulaire pour stocker le contenu modifié -->
                <input type="hidden" name="new_content" id="new_content" value="<?php echo html_entity_decode($card->getContentText()); ?>">

                <?php if (isset($_SESSION['user']) && $sessionUser->getRole() == 1) { ?>
                    <div class="text-lg" contentEditable="true" id="editableContent" oninput="updateHiddenField()"><?php echo html_entity_decode($card->getContentText()); ?></div>
                    <button type="submit" name="edit_contentText" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-4">Enregistrer</button>
                <?php } else { ?>
                    <div class="text-lg" id="editableContent"><?php echo html_entity_decode($card->getContentText()); ?></div>
                <?php } ?>
            </form>
        </div>
        <script>
            function updateHiddenField() {
                var newContent = document.getElementById("editableContent").textContent;
                document.getElementById("new_content").value = newContent;
            }
        </script>

        <div x-data="{ copied: false }" class="w-3/5 block m-auto">
            <div class="bg-black rounded-lg">
                <div class="flex rounded-t-lg bg-slate-600">
                    <button class="flex ml-auto items-center px-2 text-white font-bold text-lg" @click="copyToClipboard()">
                        <span class="text-white block ml-auto p-2 material-symbols-outlined">
                            content_copy
                        </span>Copier
                    </button>
                </div>
                <div class="text-center py-3 px-8">
                    <textarea id="myInput" class="text-white bg-black w-full h-48" readonly>
                    <?php echo ($card->getGitHub()); ?>
                    </textarea>
                </div>
            </div>
        </div>
        <div class="max-w-2xl mx-auto px-4 mt-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion (<?php echo $countComments ?>)</h2>
            </div>
            <?php foreach ($comments as $comment) : ?>
                <div class="max-w-2xl mx-auto px-4 mt-4">
                    <article class="p-6 text-base bg-white rounded-lg shadow-lg dark:bg-gray-900">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                    <img class="mr-2 w-6 h-6 rounded-full" src="<?= $comment->getUser()->getProfilPicture(); ?>" alt="Michael Gough">
                                    <?= $comment->getUser()->getNickname(); ?>
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Le <?= formatDateDay($comment->getCreatedDate()); ?></p>
                            </div>
                            <?php if (isset($_SESSION['user']) && $sessionUser->getRole() == 1) { ?>
                                <form action="../Controller/commentController.php" method="post">
                                    <input type="hidden" name="comment_id" value="<?php echo $comment->getId(); ?>">
                                    <input type="hidden" name="card_id" value="<?php echo $card->getId(); ?>">
                                    <button type="submit" name="delete_Comment" class="text-white bg-red-500 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm ml-auto px-5 py-2.5 text-center">
                                        X
                                    </button>
                                </form>
                            <?php } ?>
                        </footer>
                        <p class="text-gray-500 dark:text-gray-400"><?= $comment->getContent(); ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <div class="mt-2 text-center">
                <section class="dark:bg-gray-900 py-8 lg:py-8 antialiased">
                    <div class="max-w-2xl mx-auto px-4">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Votre commentaire :</h2>
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

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            document.execCommand("copy");

            this.copied = true;
            setTimeout(() => {
                this.copied = false;
            }, 2000);
        }
    </script>

</body>

<?php include('../views/footer.php'); ?>

</html>