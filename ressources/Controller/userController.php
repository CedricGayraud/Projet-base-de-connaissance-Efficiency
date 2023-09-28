<?php
require '../../layout.php';

function getUsersFromDatabase($bdd) {
    try {
        $query = "SELECT * FROM users";
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


?>
