<?php
include_once '../config.php';

$pdo = config::getConnexion();
if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ticketid'])) {
        $ticketid = $_GET['ticketid'];

        try {
            // Perform the deletion
            $query = $pdo->prepare("DELETE FROM ticket WHERE ticketid = :ticketid");
            $query->execute(['ticketid' => $ticketid]);

            // Redirect to the product list after deletion
            header('Location: ../view/frontoffice/contact2.php');
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