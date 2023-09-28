<?php
require '../../layout.php';

function getUsersFromDatabase($bdd) {
    try {
        $query = "SELECT id, lastName, firstName, email, role, rank, isBanned FROM users";
        $stmt = $bdd->prepare($query);
        $stmt->execute();

        // Récupérez les résultats dans un tableau associatif
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }  catch (PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
        return array(); // Retournez un tableau vide en cas d'erreur
    }
}

$results = getUsersFromDatabase($bdd);

foreach ($results as $row) {
    echo "ID : " . $row['id'] . "<br>";
    echo "Nom : " . $row['lastName'] . "<br>";
    echo "Prénom : " . $row['firstName'] . "<br>";
    echo "Email : " . $row['email'] . "<br>";
    echo "Rôle : " . $row['role'] . "<br>";
    echo "Classement : " . $row['rank'] . "<br>";
    echo "Bannis : " . $row['isBanned'] . "<br>";
    echo "<hr>";
}
?>
