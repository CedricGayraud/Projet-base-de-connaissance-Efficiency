<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

class ForumController {
    public function displayPost() {
        global $bdd;
        try {
            $affich_post = $bdd->prepare('SELECT * FROM post');
            $affich_post->execute();
            $results = $affich_post->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des données : " . $e->getMessage();
            return array(); // Retournez un tableau vide en cas d'erreur
        }
    }
}
