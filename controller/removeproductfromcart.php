<?php
include_once '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    $id = $_GET['id'];

    try {
        // Perform the deletion
        $query = $pdo->prepare("DELETE FROM cart_items WHERE Cart_Item_ID = :Cart_Item_ID");
        $query->execute(['Cart_Item_ID' => $id]);  // Corrected parameter name

        // Redirect to the product list after deletion
        header('Location: ../ok/HTML/shop-cart-right.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: Unable to connect to the database.";
}
