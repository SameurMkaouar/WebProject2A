<?php
require('../Controller/moods.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['feeling']) && isset($_POST['words']) && isset($_POST['talkaboutit'])) {
        $moodController = new moodC();
        $feeling = $_POST['feeling'];
        $words = $_POST['words'];
        $talkaboutit = $_POST['talkaboutit'];


        if ($moodController->addmood($feeling, $words, $talkaboutit)) {
            echo 'moods ajouté avec succès.';
        } else {
            echo 'Erreur lors de l\'ajout du moods.';
        }

        // Redirection
        header('Location: addmoods.php');
        exit();
    }
}
?>
