<?php
include '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    updateadminreponse();
} else {
    // Respond with an error
    echo 'Error: Unable to connect to the database.';
}

function updateadminreponse()
{
    global $pdo;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect form data
        $id = $_GET['id'];
        $reponse = $_POST['reponse'];

        try {
            // Update the record in the database
            $query = $pdo->prepare("UPDATE reponse SET 
                reponse = :reponse
                WHERE reponseid = :reponseid");

            $query->execute([
                'reponseid' => $id,
                'reponse' => $reponse
            ]);

            // Respond with success
            echo 'Update successful!';

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
