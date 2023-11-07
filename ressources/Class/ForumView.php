<?php


// ForumView.php

class ForumView
{

    public static function showPost($post)
    {
        echo "<div class='post-forum'>";

        echo "<div class='post-like-section'>";
        echo "<p class='like-count'>" . PostLike::getAllLikesByPostId($post->getId()) . " likes</p>";
        echo "<a class='like-button' ></a>";
        echo "</div>";

        echo "<div class='description-post'>";
        echo "<h2 class='title-post'>" . htmlspecialchars($post->getTitle()) . "</h2>";
        echo "<p class='author-post'>" . htmlspecialchars($post->getAuthor()->getNickname()) . "</p>";
        echo "</div>";
        echo "<div class='date-post'>";
        echo "<p class='created-date'>Last Interaction: " . htmlspecialchars($post->getDateLastInteraction()) . "</p>";
        echo "<p class='created-date'>Created Date: " . htmlspecialchars($post->getCreatedDate()) . "</p>";
        echo "</div>";
        echo "</div>";
    }

    public static function showPostForm()
    {
        echo "<div class='flex justify-center'>";
        echo "<h2>Nouveau Post</h2>";
        echo "<form action='/forum/post' method='post'>";
        echo "<label for='content'>Contenu du Message:</label>";
        echo "<textarea id='content' name='content' rows='4' cols='50' required></textarea><br>";
        echo "<input type='submit' value='Poster le Message'>";
        echo "</form>";
        echo "</div>";
    }
}