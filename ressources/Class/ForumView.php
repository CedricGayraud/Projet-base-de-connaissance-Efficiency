<?php


// ForumView.php

class ForumView
{
    public static function showPosts($posts)
    {
        foreach ($posts as $post) {
            echo "<div class='post'>";
            echo "<h2>" . htmlspecialchars($post->getTitle()) . "</h2>";
            echo "<p>" . htmlspecialchars($post->getAuthor()->getNickname()) . "</p>";
            echo "<p>Created Date: " . $post->getCreatedDate() . "</p>";
            echo "</div>";
        }
    }


    public static function showPost($post)
    {
        echo "<div class='post'>";
        echo "<h2>" . htmlspecialchars($post->getTitle()) . "</h2>";
        echo "<p>" . htmlspecialchars($post->getAuthor()->getNickname()) . "</p>";
        echo "<p>Created Date: " . htmlspecialchars($post->getCreatedDate()) . "</p>";
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