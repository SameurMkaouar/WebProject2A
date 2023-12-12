<?php
// Include your database configuration file or connection code
include(__DIR__ . '/../config.php');
$pdo = config::getConnexion();

// Check if the necessary POST parameters are set
if (isset($_POST['product_id']) && isset($_POST['new_quantity'])) {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['new_quantity'];

    try {
        // Perform the database update (replace the following line with your actual update logic)
        $stmt = $pdo->prepare("UPDATE cart_items SET Qte = :new_quantity WHERE Product_ID = :product_id");
        $stmt->bindParam(':new_quantity', $newQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        // Return a success response
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Return an error response
        echo json_encode(['success' => false, 'error' => 'Database update error: ' . $e->getMessage()]);
    }
} else {
    // Return an error response for invalid parameters
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
}
