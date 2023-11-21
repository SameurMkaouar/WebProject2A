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
            $ID = $_GET['ID'];
            if ($products) {
                foreach ($products as $product) {
                    if ($ID == $product['Product_ID']) {
                        $imageData = base64_encode($product['productMedia']);
                        // Display each product information
?>
                        <div class="with_background with_padding">

                            <div itemscope="" itemtype="http://schema.org/Product" class="product type-product row">

                                <div class="col-sm-6">
                                    <div class="images">

                                        <span class="newproduct">New</span>

                                        <span class="onsale">Sale!</span>

                                        <a href="http://wpsolar/wp-content/uploads/2013/06/poster_2_up.jpg" itemprop="image" class="woocommerce-main-image zoom" data-rel="prettyPhoto[product-gallery]">
                                            <?php
                                            echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Product Image" style="width: 350px; height: 350px; object-fit: cover;" class="attachment-shop_single wp-post-image">';
                                            ?>
                                        </a>
                                    </div>
                                    <!--eof .images -->

                                    <!-- eof .images -->
                                </div>

                                <div class="summary entry-summary col-sm-6">

                                    <h1 itemprop="name" class="product_title entry-title"><?php echo $product['productTitle'] ?></h1>

                                    <div class="product-rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">



                                    </div>

                                    <div class="product_meta">
                                        <span class="posted_in">
                                            <span class="grey">Category:</span>

                                            <?php echo $product['productCategory'] ?>

                                        </span>
                                    </div>

                                    <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">

                                        <div itemprop="description">
                                            <p><?php echo $product['productDesc'] ?></p>
                                        </div>

                                        <ul class="list1 no-bullets">
                                            <li>
                                                <p class="price">

                                                    <ins>
                                                        <span class="amount"><?php echo $product['productPrice'] ?>$</span>
                                                    </ins>
                                                </p>

                                                <meta itemprop="price" content="2">

                                                <meta itemprop="priceCurrency" content="USD">

                                                <link itemprop="availability" href="http://schema.org/InStock">

                                                <p class="stock">
                                                    <span class="grey">Availability:</span> In Stock
                                                </p>
                                                <!-- <p class="stock out-of-stock"><span class="grey">Availability:</span> <span class="highlight">Out Of Stock</span></p> -->


                                            </li>
                                        </ul>

                                        <form class="cart" method="post" enctype="multipart/form-data" action="../../controller/addproducttocart.php?productid=<?php echo $product['Product_ID'] ?>">


                                            <label class="grey" for="product_quantity">Qty:</label>

                                            <span class="quantity form-group">
                                                <input type="button" value="-" class="minus">
                                                <input type="number" step="1" min="0" name="qte" value="1" title="qte" id="qte" class="form-control ">
                                                <input type="button" value="+" class="plus">
                                            </span>

                                            <div class="pull-right">
                                                <button type="submit" class="theme_button color1 add_to_cart_button">
                                                    <i class="rt-icon2-basket"></i>
                                                    Add
                                                </button>
                                            </div>

                                        </form>
                                    </div>


                                </div>
                                <!-- .summary.col- -->

                            </div>
                            <!-- .product.row -->


                        </div>
<?php
                    }
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
