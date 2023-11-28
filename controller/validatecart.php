<?php
include(__DIR__ . '/../config.php');

$pdo = config::getConnexion();

if ($pdo) {
    function validateCart()
    {
        $cartID = $_GET['Cart_ID'];
        global $pdo;

        try {
            // Start a transaction
            $pdo->beginTransaction();

            // Validate the cart with the given ID
            $updateQuery = $pdo->prepare("UPDATE cart SET Status = 0 ");
            $updateQuery->execute();

            // Create a new cart with the same ID and status set to 1
            $insertQuery = $pdo->prepare("INSERT INTO cart (Status) VALUES (1)");
            $insertQuery->execute();

            // Commit the transaction
            $pdo->commit();
        } catch (PDOException $e) {
            // Rollback the transaction in case of an error
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    // Ensure that the cartID is set in the GET request
    if (isset($_GET['Cart_ID'])) {
        validateCart();
        echo "Cart validated successfully!";
        header('Location: ../view/HTML/shop-right.php');
    } else {
        echo "Error: Cart ID not provided in the request.";
    }
} else {
    echo "Error: Unable to connect to the database.";
}
