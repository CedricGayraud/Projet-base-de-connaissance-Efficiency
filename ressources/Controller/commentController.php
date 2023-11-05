<?php
require('../Class/Comment.php');
//Creation d'un commentaire 
if (isset($_POST['create_Comment'])) {
    $content = $_POST['content'];
    $user = $_POST['user_id'];
    $card = $_POST['card_id'];

    Comment::commentCreate($content, $user, $card);

    header("Location:../views/fiche.php?fiche=" . $card);
    exit;
}
if (isset($_POST['likeCard'])) {
    $user = $_POST['user_id'];
    $card = $_POST['card_id'];

    CardLike::likeCard($card, $user);

    header("Location:../views/fiche.php?fiche=" . $card);
    exit;
}

