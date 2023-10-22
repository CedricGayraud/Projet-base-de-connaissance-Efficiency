<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require '../Class/Card.php';


$card = $bdd->prepare("SELECT * FROM cards");
$card->execute();

$cards = [];

while ($row = $card->fetch(PDO::FETCH_ASSOC)) {
    $cards[] = new Card($row['id'], $row['title'], $row['contentText'], $row['gitHub'], $row['status'], $row['upVote'], $row['createdDate'], $row['updatedDate'], $row['summary'], $row['user'], $row['thematic'], $row['platform'], $row['img']);
}
