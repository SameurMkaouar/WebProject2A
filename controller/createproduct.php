<?php
include(__DIR__ . '/../config.php');

$pdo = config::getConnexion();

if ($pdo) {
    function CreateProduct()
    {
        global $pdo;

        try {
            // Ensure that the productMedia input is set and is a valid file
            if (isset($_FILES['productMedia']) && $_FILES['productMedia']['error'] == UPLOAD_ERR_OK) {
                $productMedia = file_get_contents($_FILES['productMedia']['tmp_name']);
            } else {
                echo "Error: Invalid file upload.";
                return;
            }

            $query = $pdo->prepare("INSERT INTO product ( productTitle, productSlug, productPrice, productShortDesc, productDesc, productPublishDate, productPublishTime, productCategory, productTags, productMedia) VALUES (:productTitle, :productSlug, :productPrice, :productShortDesc, :productDesc, :productPublishDate, :productPublishTime, :productCategory, :productTags, :productMedia)");

            $query->execute([
                'productTitle' => $_POST['productTitle'],
                'productSlug' => $_POST['productSlug'],
                'productPrice' => $_POST['productPrice'],
                'productShortDesc' => $_POST['productShortDesc'],
                'productDesc' => $_POST['productDesc'],
                'productPublishDate' => $_POST['productPublishDate'],
                'productPublishTime' => $_POST['productPublishTime'],
                'productCategory' => $_POST['productCategory'],
                'productTags' => $_POST['productTags'],
                'productMedia' => $productMedia,
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        CreateProduct();
        //header('Location: readproduct.php');
        header('Location: ../view/HTML/admin_products.php');
    }
} else {
    echo "Error: Unable to connect to the database.";
}
