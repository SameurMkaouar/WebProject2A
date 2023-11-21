<?php
include(__DIR__ . '/../config.php');


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
                    <li class="product type-product">
                        <div class="side-item no-content-padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="item-media">
                                        <a href="shop-product-right.php?ID=<?php echo $product['Product_ID'] ?>">
                                            <?php
                                            echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Product Image" style="width: 350px; height: 350px; object-fit: cover;" />';
                                            ?>
                                            <span class="newproduct">New</span>
                                        </a>
                                        <div class="product-buttons">
                                            <a href="#" rel="nofollow" class="favorite_button">
                                                Add to Favorites
                                            </a>
                                            <a href="#" rel="nofollow" class="added_to_cart">
                                                Add To Cart
                                            </a>
                                            <a href="#" rel="nofollow" class="add_to_cart_button">
                                                Go to Cart
                                            </a>
                                        </div>
                                    </div>
                                    <h3>
                                        <a href="shop-product-right.html"><?php echo $product['productTitle'] ?></a>
                                    </h3>
                                </div>


                                <div class="col-md-6">
                                    <div class="item-content">
                                        <h3>
                                            <a href="shop-product-right.html">
                                                <!-- echo the productTitle -->
                                                <?php echo $product['productTitle'] ?>
                                            </a>
                                        </h3>

                                        <h4>Product Description</h4>
                                        <p class="product-description">
                                            <?php echo $product['productDesc'] ?>
                                        </p>

                                        <h4>Product Rating</h4>
                                        <div class="star-rating" title="Rated 4.00 out of 5">
                                            <span style="width: 80%">
                                                <strong class="rating">4.00</strong> out of 5
                                            </span>
                                        </div>

                                        <span class="price">
                                            <span>
                                                <span class="amount">$<?php echo $product['productPrice'] ?></span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
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
