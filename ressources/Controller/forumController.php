<?php

include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/Post.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/ForumView.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/PostLike.php');



class ForumController
{
    public function displayPosts($numberOfPostsToShow, $isTrending)
    {
        $posts = Post::getPosts();

        if ($isTrending) {
            usort($posts, function($a, $b) {
                $likesA = PostLike::getAllLikesByPostId($a->getId());
                $likesB = PostLike::getAllLikesByPostId($b->getId());
                return $likesB - $likesA;
            });
        }

        for ($i = 0; $i < min($numberOfPostsToShow, count($posts)); $i++) {
            ForumView::showPost($posts[$i]);
        }
    }

    public function displayUserPosts()
    {
        $posts = Post::getAllPostsByUserId(getSessionUser()->getId());
        if (count($posts) == 0) {
            echo "<p>Vous n'avez pas encore posté de message.</p>";
        }
        else {
            for ($i = 0; $i < count($posts); $i++) {
                ForumView::showPost($posts[$i]);
            }
        }
    }


    public function displayPost($postId)
    {
        $post = Post::getPostById($postId);
        ForumView::showPost($post);
    }



    public function showPostForm()
    {
        ForumView::showPostForm();
    }

    public function getPostById($postId): ?Post
    {
        return Post::getPostById($postId);
    }


}
