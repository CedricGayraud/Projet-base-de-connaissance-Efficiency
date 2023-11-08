<?php


// ForumView.php
//layout.php

require ($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

class ForumView
{

    public static function showPost($post)
    {
        global $bdd;
        echo "<div class='post-forum flex row'>";

        echo "<div class='post-like-section flex column'>";
        echo "<p class='like-count'>" . PostLike::getAllLikesByPostId($post->getId()) . "</p>";
        echo "<a class='like-button' onclick='' >";
        if (PostLike::isLiked($post->getId(), User::getSessionUser($bdd))){
            echo '<svg fill="#FB335B" id="like-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"></path> </g> </g></svg>';
        }else {
            echo '<svg fill="#000000" id="like-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.701 471.701" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M433.601,67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7,13.6-92.4,38.3l-12.9,12.9l-13.1-13.1 c-24.7-24.7-57.6-38.4-92.5-38.4c-34.8,0-67.6,13.6-92.2,38.2c-24.7,24.7-38.3,57.5-38.2,92.4c0,34.9,13.7,67.6,38.4,92.3 l187.8,187.8c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-3.9l188.2-187.5c24.7-24.7,38.3-57.5,38.3-92.4 C471.801,124.501,458.301,91.701,433.601,67.001z M414.401,232.701l-178.7,178l-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3 s10.7-53.7,30.3-73.2c19.5-19.5,45.5-30.3,73.1-30.3c27.7,0,53.8,10.8,73.4,30.4l22.6,22.6c5.3,5.3,13.8,5.3,19.1,0l22.4-22.4 c19.6-19.6,45.7-30.4,73.3-30.4c27.6,0,53.6,10.8,73.2,30.3c19.6,19.6,30.3,45.6,30.3,73.3 C444.801,187.101,434.001,213.101,414.401,232.701z"></path> </g> </g></svg>';
        }
        echo "</a>";
        echo "</div>";

        echo "<div class='description-post flex column'>";
        echo "<h2 class='title-post'>" . htmlspecialchars($post->getTitle()) . "</h2>";
        echo "<p class='author-post'>" . htmlspecialchars($post->getAuthor()->getNickname()) . "</p>";
        echo "</div>";
        echo "<div class='date-post flex column'>";
        echo "<p class='created-date'>Last Interaction: " . htmlspecialchars($post->getDateLastInteraction()) . "</p>";
        echo "<p class='created-date'>Created Date: " . htmlspecialchars($post->getCreatedDate()) . "</p>";
        echo "</div>";

        echo "</div>";
    }

    public static function showPostForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];


                if (!empty($title) && !empty($content)) {
                    $userId = getSessionUser()->getId();
                    Post::createPost($title, $content, $userId);

                    echo "Post créé avec succès !";
                } else {
                    echo "Veuillez remplir tous les champs du formulaire.";
                }
            }
        }

        // Affiche le formulaire HTML
        ?>
        <form method="POST" action="">
            <!-- Assure-toi d'ajuster les noms des champs en fonction de ton formulaire -->
            <label for="title">Titre :</label>
            <input type="text" name="title" required>
            <label for="content">Contenu :</label>
            <textarea name="content" required></textarea>
            <input type="submit" name="submit" value="Créer le post">
        </form>
        <?php
    }

    public static function showCommentForm($postId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['commentSubmit'])) {
                $commentContent = $_POST['commentContent'];

                if (!empty($commentContent)) {
                    $userId = getSessionUser()->getId();
                    CommentForum::addComment($userId, $postId, $commentContent);

                    echo "Commentaire ajouté avec succès !";

                } else {
                    echo "Veuillez saisir un commentaire.";
                }
            }
        }

        ?>
        <form method="POST" action="">
            <label for="commentContent">Commentaire :</label>
            <textarea name="commentContent" required></textarea>
            <input type="submit" name="commentSubmit" value="Ajouter un commentaire">
        </form>
        <?php
    }

    //show post form

}