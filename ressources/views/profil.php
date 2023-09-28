<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require 'user.php';
require '../Controller/userController.php';

// Remplacez ces valeurs factices par la récupération des données de la base de données
// Utilisez la méthode getUsersFromDatabase pour obtenir les données réelles de l'utilisateur
$userData = getUsersFromDatabase($bdd);

// Créez une instance de la classe User avec les données de l'utilisateur
$user = new User (
    $userData['id'],
    $userData['lastName'],
    $userData['firstName'],
    $userData['email'],
    $userData['role'],
    $userData['rank'],
    $userData['isBanned']
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div class="sm:text-center">
        <h1>Mon Profil</h1>
        <p>Nom : <?php echo $user->getNom(); ?></p>
        <p>Prénom : <?php echo $user->getPrenom(); ?></p>
        <p>Email : <?php echo $user->getEmail(); ?></p>
        <p>Rôle : <?php echo $user->getRole(); ?></p>
        <p>Rank : <?php echo $user->getRank(); ?></p>
        <p>Statut de bannissement : <?php echo $user->getIsBanned(); ?></p>
    </div>
</body>

</html>
