<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
//Le fichier layout contient la connexion à la base de données ainsi qu'au cdn de tailwind

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <h1 class="bg-yellow-400">CECI EST LA PAGE fiche <?php var_dump($currentPage); ?></h1>


</body>

</html>