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
<<<<<<< HEAD
            header('Location: ../ok/HTML/admin_products.php');
=======
            header("Location: readproduct.php");
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
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
