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
