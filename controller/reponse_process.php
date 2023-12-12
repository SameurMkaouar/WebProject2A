<?php
include '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reponseid'])) {
        // Collect form data
        $reponseid= $_POST['reponseid'];
        $reponse = $_POST['reponse'];

        try {
            // Update the product in the database
            $query = $pdo->prepare("UPDATE reponse SET 
                reponse = :reponse
                WHERE reponseid = :reponseid");


            $query->execute([
                'reponseid' => $reponseid,
                'reponse' => $reponse,
            ]);

            // Redirect to the product list or show a success message
            header("Location: ../view/backoffice/admin_tickets.php");
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