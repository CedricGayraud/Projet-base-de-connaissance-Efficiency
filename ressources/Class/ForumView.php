<?php


// ForumView.php

class ForumView
{

    public static function showPost($post)
    {
        echo "<div class='post-forum flex row'>";

        echo "<div class='post-like-section flex column'>";
        echo "<p class='like-count'>" . PostLike::getAllLikesByPostId($post->getId()) . " likes</p>";
        echo "<a class='like-button' ></a>";
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
            <!-- Assure-toi d'ajuster les noms des champs en fonction de ton formulaire -->
            <label for="commentContent">Commentaire :</label>
            <textarea name="commentContent" required></textarea>
            <input type="submit" name="commentSubmit" value="Ajouter un commentaire">
        </form>
        <?php
    }

    //show post form

}