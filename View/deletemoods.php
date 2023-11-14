<?php
include_once '../config.php';
$pdo = config::getConnexion();

if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['UserID'])) {
        $UserID = $_GET['UserID'];

        try {
            // Perform the deletion
            $query = $pdo->prepare("DELETE FROM today_moods WHERE UserID = :UserID");
            $query->execute(['UserID' => $UserID]);

            // Redirect to the product list after deletion
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