<?php
include '../config.php';

$pdo = config::getConnexion();

if ($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Product_ID'])) {
        // Collect form data
        $productId = $_POST['Product_ID'];
        $productTitle = $_POST['productTitle'];
        $productSlug = $_POST['productSlug'];
        $productPrice = $_POST['productPrice'];
        $productShortDesc = $_POST['productShortDesc'];
        $productDesc = $_POST['productDesc'];
        $productPublishDate = $_POST['productPublishDate'];
        $productPublishTime = $_POST['productPublishTime'];
        $productCategory = $_POST['productCategory'];
        $productTags = $_POST['productTags'];
        $productMedia = $_POST['productMedia'];

        try {
            if (isset($_FILES['productMedia']) && $_FILES['productMedia']['error'] == UPLOAD_ERR_OK) {
                $productMedia = file_get_contents($_FILES['productMedia']['tmp_name']);
            } else {
                echo "Error: Invalid file upload.";
                return;
            }
            // Update the product in the database
            $query = $pdo->prepare("UPDATE product SET 
                productTitle = :productTitle,
                productSlug = :productSlug,
                productPrice = :productPrice,
                productShortDesc = :productShortDesc,
                productDesc = :productDesc,
                productPublishDate = :productPublishDate,
                productPublishTime = :productPublishTime,
                productCategory = :productCategory,
                productTags = :productTags,
                productMedia = :productMedia
                WHERE Product_ID = :Product_ID");

            $query->execute([
                'Product_ID' => $productId,
                'productTitle' => $productTitle,
                'productSlug' => $productSlug,
                'productPrice' => $productPrice,
                'productShortDesc' => $productShortDesc,
                'productDesc' => $productDesc,
                'productPublishDate' => $productPublishDate,
                'productPublishTime' => $productPublishTime,
                'productCategory' => $productCategory,
                'productTags' => $productTags,
                'productMedia' => $productMedia,
            ]);

            // Redirect to the product list or show a success message
            //header('Location: ../view/HTML/admin_products.php');
            header('Location: ../view/backoffice/admin_products.php');
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