<?php
include_once '../config.php';
//include 'updateproduct.php';

$pdo = config::getConnexion();

if ($pdo) {
    function readProducts()
    {
        global $pdo;
        try {
            $query = $pdo->query("SELECT * FROM product");
            $products = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($products) {
                foreach ($products as $product) {
                    // Display each product information
                    echo "<h2>{$product['productTitle']}</h2>";
                    echo "<p>ID: {$product['Product_ID']}</p>";
                    echo "<p>Slug: {$product['productSlug']}</p>";
                    echo "<p>Price: {$product['productPrice']}</p>";
                    echo "<p>Short Description: {$product['productShortDesc']}</p>";
                    echo "<p>Description: {$product['productDesc']}</p>";
                    echo "<p>Publish Date: {$product['productPublishDate']}</p>";
                    echo "<p>Publish Time: {$product['productPublishTime']}</p>";
                    echo "<p>Category: {$product['productCategory']}</p>";
                    echo "<p>Tags: {$product['productTags']}</p>";
                    echo "<p>Media: {$product['productMedia']}</p>";

                    // Add link for updating the product
                    echo "<p><a href='updateproduct.php?Product_ID={$product['Product_ID']}'>Update Product</a></p>";
                    // delete lol
                    echo "<p><a href='deleteproduct.php?Product_ID={$product['Product_ID']}'>Delete Product</a></p>";


                    echo "<hr>";
                }
            } else {
                echo "No products found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Call the function to show products
    readProducts();
} else {
    echo "Error: Unable to connect to the database.";
}
