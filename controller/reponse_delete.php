<?php
include_once '../config.php';

$pdo = config::getConnexion();
if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reponseid'])) {
        $reponseid = $_GET['reponseid'];

        try {
            // Perform the deletion
            $query = $pdo->prepare("DELETE FROM reponse WHERE reponseid = :reponseid");
            $query->execute(['reponseid' => $reponseid]);

            // Redirect to the product list after deletion
            header('Location: ../view/backoffice/admin_tickets.php');
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