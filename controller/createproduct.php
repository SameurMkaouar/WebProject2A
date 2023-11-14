<?php
include_once '../config.php';

$pdo = config::getConnexion();
if ($pdo) {
    function CreateProduct()
    {
        global $pdo;
        try {
            $query = $pdo->prepare("INSERT INTO product ( productTitle, productSlug, productPrice, productShortDesc, productDesc, productPublishDate, productPublishTime, productCategory,productTags, productMedia) VALUES (:productTitle, :productSlug, :productPrice, :productShortDesc, :productDesc, :productPublishDate, :productPublishTime, :productCategory, :productTags, :productMedia)");
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
                'productMedia' => $_POST['productMedia']
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        CreateProduct();
        header('Location: readproduct.php');
        //header('Location: ../themeforest-OjBoMxIv-psychologist-personal-singlemulti-page-html-template-with-page-builder-and-admin-pages/HTML/shop-right.html');
    }
} else {
    echo "Error: Unable to connect to the database.";
}
