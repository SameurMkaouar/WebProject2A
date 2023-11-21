<?php
include_once '../config.php';

$pdo = config::getConnexion();
if ($pdo) {
    function Createticket()
    {
        global $pdo;

        try {
            $query = $pdo->prepare("INSERT INTO ticket (name, subject, message, date) VALUES (:name, :subject, :message, NOW())");
            $query->execute([
                'name' => $_POST['name'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
            ]);
            echo "Ticket created successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Createticket();
        header('Location: ../view/contact.php');
    }
} else {
    echo "Error: Unable to connect to the database.";
}
?>