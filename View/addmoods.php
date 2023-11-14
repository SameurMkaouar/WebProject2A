<?php
include_once '../config.php';

$pdo = config::getConnexion();
if ($pdo) {
    function CreateProduct()
    {
        global $pdo;
        try {
            $query = $pdo->prepare("INSERT INTO today_moods (talkaboutit) VALUES (:talkaboutit)");
            $query->execute([
                'talkaboutit' => $_POST['talkaboutit'],

            ]);
            echo "Product created successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        CreateProduct();
        header('Location: showamoods.php');
    }
} else {
    echo "Error: Unable to connect to the database.";
}