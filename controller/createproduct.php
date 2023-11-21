<?php
<<<<<<< HEAD
include(__DIR__ . '/../config.php');

$pdo = config::getConnexion();

=======
include_once '../config.php';

$pdo = config::getConnexion();
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
if ($pdo) {
    function CreateProduct()
    {
        global $pdo;
<<<<<<< HEAD

        try {
            // Ensure that the productMedia input is set and is a valid file
            if (isset($_FILES['productMedia']) && $_FILES['productMedia']['error'] == UPLOAD_ERR_OK) {
                $productMedia = file_get_contents($_FILES['productMedia']['tmp_name']);
            } else {
                echo "Error: Invalid file upload.";
                return;
            }

            $query = $pdo->prepare("INSERT INTO product ( productTitle, productSlug, productPrice, productShortDesc, productDesc, productPublishDate, productPublishTime, productCategory, productTags, productMedia) VALUES (:productTitle, :productSlug, :productPrice, :productShortDesc, :productDesc, :productPublishDate, :productPublishTime, :productCategory, :productTags, :productMedia)");

=======
        try {
            $query = $pdo->prepare("INSERT INTO product ( productTitle, productSlug, productPrice, productShortDesc, productDesc, productPublishDate, productPublishTime, productCategory,productTags, productMedia) VALUES (:productTitle, :productSlug, :productPrice, :productShortDesc, :productDesc, :productPublishDate, :productPublishTime, :productCategory, :productTags, :productMedia)");
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
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
<<<<<<< HEAD
                'productMedia' => $productMedia,
=======
                'productMedia' => $_POST['productMedia']
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        CreateProduct();
<<<<<<< HEAD
        //header('Location: readproduct.php');
        header('Location: ../ok/HTML/admin_products.php');
=======
        header('Location: readproduct.php');
        //header('Location: ../themeforest-OjBoMxIv-psychologist-personal-singlemulti-page-html-template-with-page-builder-and-admin-pages/HTML/shop-right.html');
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
    }
} else {
    echo "Error: Unable to connect to the database.";
}
