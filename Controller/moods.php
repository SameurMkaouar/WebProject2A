<?php
require('../config.php');

class moodC {
    public function listmoods() {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare('SELECT * FROM today_moods');
            $query->execute();
            $result = $query->fetchAll();

            return $result; // Retourne les moods
        } catch (PDOException $e) {
            echo 'Erreur de requête SQL : ' . $e->getMessage();
            return array(); // Retourner un tableau vide en cas d'erreur
        }
    }

    public function deletemood($id) {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare('DELETE FROM today_moods WHERE idmood = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return true; // Retourne vrai si la suppression a réussi
        } catch (PDOException $e) {
            echo 'Erreur de suppression : ' . $e->getMessage();
            return false; // Retourne faux en cas d'erreur de suppression
        }
    }

    public function addmood($feeling, $words, $talkaboutit) {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare('INSERT INTO today_moods (feeling, words, talkaboutit) VALUES (:feeling, :words, :talkaboutit)');
            $query->bindParam(':feeling', $feeling);
            $query->bindParam(':words', $words);
            $query->bindParam(':talkaboutit', $talkaboutit);
            $query->execute();
            return true; // Retourne vrai si l'ajout a réussi
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'ajout du mood : ' . $e->getMessage();
            return false; // Retourne faux en cas d'erreur d'ajout
        }

    }

    public function getmoodById($id) {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare('SELECT * FROM today_moods WHERE idmood = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch();

            return $result; // Retourne les informations du mood
        } catch (PDOException $e) {
            echo 'Erreur lors de la récupération des informations du mood : ' . $e->getMessage();
            return false; // Retourne faux en cas d'erreur
        }
    }

    public function updatemood($id, $feeling, $words, $talkaboutit) {
        $pdo = config::getConnexion();

        try {
            $query = $pdo->prepare('UPDATE today_moods SET feeling = :feeling, words = :words, talkaboutit = :talkaboutit WHERE idmood = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':feeling', $feeling);
            $query->bindParam(':words', $words);
            $query->bindParam(':talkaboutit', $talkaboutit);
            $query->execute();
            return true; // Retourne vrai si la mise à jour a réussi
        } catch (PDOException $e) {
            echo 'Erreur lors de la mise à jour du mood : ' . $e->getMessage();
            return false; // Retourne faux en cas d'erreur de mise à jour
        }
    }
}
?>


