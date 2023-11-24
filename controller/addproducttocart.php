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
            $query = $pdo->prepare("INSERT INTO cart_items ( Product_ID, Qte) VALUES (:Product_ID, :Qte)");

            $query->execute([
                'Product_ID' => $productid,
                'Qte' => $_POST['qte']
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        AddProductToCart();
        //header('Location: readproduct.php');
        header('Location: ../view/HTML/shop-product-right.php?ID=' . $_GET['productid'] . '');
    }
} else {
    echo "Error: Unable to connect to the database.";
}
