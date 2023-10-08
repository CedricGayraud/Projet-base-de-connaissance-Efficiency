<?php
//Récupération de toutes les thématiques
$queryThematics = $bdd->prepare("SELECT * FROM thematics");
$queryThematics->execute();

$thematics = [];

while ($row = $queryThematics->fetch(PDO::FETCH_ASSOC)) {
    $thematics[] = new Thematic($row['id'], $row['name'], $row['description'], $row['color']);
}

//Récupération de toutes les platformes
$queryPlatforms = $bdd->prepare("SELECT * FROM platforms");
$queryPlatforms->execute();

$platforms = [];

while ($row = $queryPlatforms->fetch(PDO::FETCH_ASSOC)) {
    $platforms[] = new Platform($row['id'], $row['name'], $row['description'], $row['link'], $row['img']);
}

//Récupération de toutes les fiches
$queryCards = $bdd->prepare("SELECT * FROM cards");
$queryCards->execute();

$cards = [];

while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
    $cards[] = new Card($row['id'], $row['title'], $row['contentText'], $row['gitHub'], $row['status'], $row['upVote'], $row['createdDate'], $row['updatedDate'], $row['summary'], $row['user'], $row['thematic'], $row['platform'], $row['img']);
}
