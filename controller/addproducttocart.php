<?php
include(__DIR__ . '/../config.php');

$pdo = config::getConnexion();

if ($pdo) {
    function AddProductToCart()
    {
        global $pdo;

        try {
            // Ensure that the productMedia input is set and is a valid file
            $productid = $_GET['productid'];

            // Find the Cart_ID of the first cart with Status = 1
            $queryCart = $pdo->prepare("SELECT Cart_ID FROM cart WHERE Status = 1 LIMIT 1");
            $queryCart->execute();
            $cartInfo = $queryCart->fetch(PDO::FETCH_ASSOC);

            if (!$cartInfo) {
                // No active cart found with Status = 1
                echo "Error: No active cart with Status = 1 found.";
                return;
            }

            // Insert the product into cart_items with the retrieved Cart_ID
            $query = $pdo->prepare("INSERT INTO cart_items (Cart_ID, Product_ID, Qte) VALUES (:Cart_ID, :Product_ID, :Qte)");
            $query->execute([
                'Cart_ID' => $cartInfo['Cart_ID'],
                'Product_ID' => $productid,
                'Qte' => $_POST['qte']
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        AddProductToCart();
        header('Location: ../view/HTML/shop-product-right.php?ID=' . $_GET['productid']);
    }
} else {
    echo "Error: Unable to connect to the database.";
}
