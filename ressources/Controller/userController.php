<?php
function getSessionUser() {
    global $bdd;
    try {
        if (isset($_SESSION['user'])) {

            $affich_users = $bdd->prepare('SELECT * FROM users WHERE id=?');
            $affich_users->execute(array($_SESSION['user']));
            $results = $affich_users->fetch();
            return $results;
        }
       
        
    }  catch (PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
        return array(); // Retournez un tableau vide en cas d'erreur
    }
}





function modifyUserDetails() {
    try {
        global $bdd;
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
                  WHERE id = ?";
        
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        // Le bouton "Modifier les informations" a été cliqué
        // Affichez le formulaire de modification (déjà géré dans le fichier de vue)
    } elseif (isset($_POST['save'])) {
        // Le bouton "Enregistrer" a été cliqué
        // Traitez les données du formulaire de modification et mettez à jour la base de données
        
        $newData = [
            'lastName' => $_POST['last_name'],
            'firstName' => $_POST['first_name'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'rank' => $_POST['rank'],
            'isBanned' => isset($_POST['is_banned']) ? 1 : 0, // Exemple pour une case à cocher
        ];

        $userId = $_POST['user_id']; // Assurez-vous d'avoir un champ caché pour l'ID de l'utilisateur

        // Appelez votre fonction de mise à jour des détails de l'utilisateur
        if (modifyUserDetails($bdd, $userId, $newData)) {
            // La mise à jour a réussi, redirigez l'utilisateur ou affichez un message de succès
            header('Location: profil.php');
            exit;
        } else {
            // La mise à jour a échoué, affichez un message d'erreur si nécessaire
            echo "Erreur lors de la mise à jour des informations.";
        }
    }
}

?>
