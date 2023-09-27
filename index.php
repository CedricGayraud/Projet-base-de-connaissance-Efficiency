<?php
require('./layout.php');
//Le fichier layout contient la connexion à la base de données ainsi qu'au cdn de tailwind

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Effiiciency</title>
</head>

<body>
    <?php include 'ressources/views/sidebar.php' ?>
    <h1 class="bg-green-700">CECI EST LA PAGE INDEX <?php var_dump($currentPage); ?></h1>


</body>

</html>