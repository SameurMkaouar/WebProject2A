<?php
include '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    updateArchived();
} else {
    // Respond with an error
    echo 'Error: Unable to connect to the database.';
}

function updateArchived()
{
    global $pdo;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Collect form data
        $id = $_GET['ticketid'];

        try {
            // Update the record in the database
            $query = $pdo->prepare("UPDATE ticket SET 
                archived = -archived
                WHERE ticketid = :ticketid");

            $query->execute([
                'ticketid' => $id,
            ]);

            // Respond with success
            echo 'Update successful!';
            header('Location: ../view/frontoffice/contact2.php');

        } catch (PDOException $e) {
            // Respond with an error
            echo 'Error updating record: ' . $e->getMessage();
        }
    } else {
        // Respond with an error
        echo 'Error: Invalid request method.';
    }
}
?>
