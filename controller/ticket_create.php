<?php
include_once '../config.php';

$pdo = config::getConnexion();
if ($pdo) {
    function Createticket()
    {
        global $pdo;

        // Assuming you have a user_id stored in the session
        session_start();
        $user_id = $_SESSION['user_id'];

        try {
            $query = $pdo->prepare("INSERT INTO ticket (Id, subject, message, date) VALUES (:Id, :subject, :message, NOW())");
            $query->execute([
                'Id' => $user_id,
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
        header('Location: ../view/frontoffice/contact2.php');
    }
} else {
    echo "Error: Unable to connect to the database.";
}
?>
