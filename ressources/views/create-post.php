<?php

// Create post forum php file

require ($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/ressources/Controller/forumController.php');
$forumController = new ForumController();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum - Créer un post</title>
    <style>







    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="forum-body">
    <header>
        <h1>Créer un post</h1>
    </header>
    <div id="post-form">
        <?php
        $forumController->showPostForm();
        ?>
    </div>
</div>