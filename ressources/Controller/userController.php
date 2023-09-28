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




function modifyUserDetails($bdd, $id, $newData) {
    try {
        // Définir la requête SQL pour mettre à jour les détails de l'utilisateur
        $query = "UPDATE users 
                   SET 
                      nickname = :nickname,
                      lastName = :lastName, 
                      firstName = :firstName, 
                      email = :email, 
                      role = :role, 
                      rank = :rank, 
                      isBanned = :isBanned 
                  WHERE id = :id";
        
        // Préparer la requête SQL
        $stmt = $bdd->prepare($query);
        
        // Liage des paramètres
        $stmt->bindParam(':lastName', $newData['lastName']);
        $stmt->bindParam(':firstName', $newData['firstName']);
        $stmt->bindParam(':email', $newData['email']);
        $stmt->bindParam(':role', $newData['role']);
        $stmt->bindParam(':rank', $newData['rank']);
        $stmt->bindParam(':isBanned', $newData['isBanned']);
        $stmt->bindParam(':id', $id);
        
        // Exécuter la requête SQL
        $stmt->execute();
        
        // La mise à jour a réussi
        return true;
    } catch (PDOException $e) {
        // En cas d'erreur, vous pouvez choisir de la gérer ici.
        // Par exemple, affichez un message d'erreur ou enregistrez-le dans un fichier de journal.
        // Pour l'instant, nous retournons false en cas d'erreur.
        return false;
    }
}

?>
