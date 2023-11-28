<?php
include '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticketid'])) {
        // Collect form data
        $ticketid= $_POST['ticketid'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        try {
            // Update the product in the database
            $query = $pdo->prepare("UPDATE ticket SET 
                subject = :subject,
                message = :message
                WHERE ticketid = :ticketid");


            $query->execute([
                'ticketid' => $ticketid,
                'subject' => $subject,
                'message' => $message
            ]);

            // Redirect to the product list or show a success message
            header("Location: ../view/contact2.php");
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