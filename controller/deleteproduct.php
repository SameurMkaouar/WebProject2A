<?php
include_once '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['Product_ID'])) {
        $productId = $_GET['Product_ID'];

        try {
            // Perform the deletion
            $query = $pdo->prepare("DELETE FROM product WHERE Product_ID = :Product_ID");
            $query->execute(['Product_ID' => $productId]);

            // Redirect to the product list after deletion
            header("Location: readproduct.php");
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
