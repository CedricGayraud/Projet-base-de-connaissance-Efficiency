<?php
include '../../layout.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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





function modifyUserDetails($id, $newData) {
    try {
    global $bdd;
    var_dump($newData);
        
        // Définir la requête SQL pour mettre à jour les détails de l'utilisateur
        $query = "UPDATE users 
                   SET 
                      nickname = :nickname,
                      lastName = :lastName, 
                      firstName = :firstName, 
                      email = :email";
        
        // Si un nouveau mot de passe a été fourni, inclure la colonne "password" dans la requête
        if (isset($newData['password']) && !empty($newData['password'])) {
            $query .= ", password = :password ";
        }
            // Terminez la requête avec la clause WHERE pour spécifier l'utilisateur à mettre à jour
            $query .= "WHERE id = :id";
        
        
        // Préparer la requête SQL
        $stmt = $bdd->prepare($query);
        
        // Liage des paramètres
        $stmt->bindParam(':nickname', $newData['nickname']); // Assurez-vous de disposer d'une clé 'nickname' dans $newData
        $stmt->bindParam(':lastName', $newData['lastName']);
        $stmt->bindParam(':firstName', $newData['firstName']);
        $stmt->bindParam(':email', $newData['email']);
        if (isset($newData['password']) && !empty($newData['password'])) {
            $hashedPassword = password_hash($newData['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword);
        }
        $stmt->bindParam(':id', $id);
        
        // Exécuter la requête SQL
        $stmt->execute();
        
        // La mise à jour a réussi
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
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
        var_dump($_POST);

        $userId = $_POST['user_id']; // Assurez-vous d'avoir un champ caché pour l'ID de l'utilisateur
        $newData = [
            'nickname' => $_POST['nickname'],
            'lastName' => $_POST['lastName'],
            'firstName' => $_POST['firstName'],
            'email' => $_POST['email'],
            'password' => $_POST['new_password'],
        ];

        // Ajoutez ici la vérification des mots de passe
        if (!empty($newData['password']) && $newData['password'] !== $_POST['confirm_password']) {
            echo "Les mots de passe ne correspondent pas.";
            return false;
        }

        // Appelez votre fonction de mise à jour des détails de l'utilisateur
        if (modifyUserDetails($userId, $newData)) {
            // La mise à jour a réussi, redirigez l'utilisateur ou affichez un message de succès
            header('Location:../views/profil.php');
            exit;
        } else {
            // La mise à jour a échoué, affichez un message d'erreur si nécessaire
            echo "Erreur lors de la mise à jour des informations.";
            return false;
        }
    }
}

?>