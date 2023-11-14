<?php
include '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UserID'])) {
        // Collect form data
        $UserID= $_POST['UserID'];
        $talkaboutit = $_POST['talkaboutit'];

        try {
            // Update the product in the database
            $query = $pdo->prepare("UPDATE today_moods SET 
                talkaboutit = :talkaboutit
                WHERE UserID = :UserID");


            $query->execute([
                'UserID' => $UserID,
                'talkaboutit' => $talkaboutit
            ]);

            // Redirect to the product list or show a success message
            header("Location: showamoods.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Error: Unable to connect to the database.";
}
