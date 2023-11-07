<?php

include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/Post.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/ForumView.php');



class ForumController
{
    public function displayPosts($numberOfPostsToShow)
    {
        $posts = Post::getPosts();
        for ($i = 0; $i < min($numberOfPostsToShow, count($posts)); $i++) {
            ForumView::showPost($posts[$i]);
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
