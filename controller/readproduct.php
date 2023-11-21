<?php
include(__DIR__ . '/../config.php');
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

                    $imageData = base64_encode($product['productMedia']);
                    // Display each product information
                    // echo "<h2>{$product['productTitle']}</h2>";
                    // echo "<p>ID: {$product['Product_ID']}</p>";
                    // echo "<p>Slug: {$product['productSlug']}</p>";
                    // echo "<p>Price: {$product['productPrice']}</p>";
                    // echo "<p>Short Description: {$product['productShortDesc']}</p>";
                    // echo "<p>Description: {$product['productDesc']}</p>";
                    // echo "<p>Publish Date: {$product['productPublishDate']}</p>";
                    // echo "<p>Publish Time: {$product['productPublishTime']}</p>";
                    // echo "<p>Category: {$product['productCategory']}</p>";
                    // echo "<p>Tags: {$product['productTags']}</p>";
                    // echo "<p>Media: {$product['productMedia']}</p>";

                    // // Add link for updating the product
                    // echo "<p><a href='updateproduct.php?Product_ID={$product['Product_ID']}'>Update Product</a></p>";
                    // // delete lol
                    // echo "<p><a href='deleteproduct.php?Product_ID={$product['Product_ID']}'>Delete Product</a></p>";


                    // echo "<hr>";

?>
                    <tr class="item-editable">
                        <td class="media-middle text-center">
                            <input type="checkbox" />
                        </td>
                        <td>
                            <div class="media">
                                <div class="media-left media-middle">
                                    <?php
                                    echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Product Image" style="width: 40px; height: 40px; object-fit: cover;" />';
                                    ?>


                                </div>
                                <div class="media-body media-middle">
                                    <h5>
                                        <a href="admin_product.html"> <?php echo $product['productTitle'] ?> </a>
                                    </h5>
                                </div>
                            </div>
                        </td>
                        <td class="media-middle">
                            <strong><?php echo $product['productPrice'] ?></strong>
                        </td>
                        <td class="media-middle">
                            <time datetime="2017-02-08T20:25:23+00:00" class="entry-date"><?php echo $product['productPublishDate'] ?></time>
                        </td>
                        <td class="media-middle"><?php echo $product['productCategory'] ?> </td>
                        <td class="media-middle"><?php echo "<p><a href='../../controller/updateproduct.php?Product_ID={$product['Product_ID']}'>Update Product</a></p>"; ?> </td>
                        <td class="media-middle"><?php echo "<p><a href='../../controller/deleteproduct.php?Product_ID={$product['Product_ID']}'>Delete Product</a></p>"; ?> </td>

                    </tr>
<?php
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
