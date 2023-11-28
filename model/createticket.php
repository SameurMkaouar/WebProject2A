<?php
include_once '../config.php';

$pdo = config::getConnexion();
if ($pdo) {
    function Createticket()
    {
        global $pdo;

        try {
            $query = $pdo->prepare("INSERT INTO ticket (name, email,subject, message, date) VALUES (:name, :email,:subject, :message, NOW())");
            $query->execute([
                'name' => $_POST['name'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
                'email' => $_POST['email'],
            ]);
            echo "Ticket created successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        Createticket();
        header('Location: ../view/contact2.php');
    }
} else {
    echo "Error: Unable to connect to the database.";
}
?>