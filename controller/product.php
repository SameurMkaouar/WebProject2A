<?php
require('../config.php');

$pdo = config::getConnexion();

class productC
{
    public function AddProductToCart()
    {
        global $pdo;

        try {
            // Ensure that the productMedia input is set and is a valid file
            $productid = $_GET['productid'];
            $query = $pdo->prepare("INSERT INTO cart_items ( Product_ID, Qte) VALUES (:Product_ID, :Qte)");

            $query->execute([
                'Product_ID' => $productid,
                'Qte' => $_POST['qte']
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function CreateProduct()
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

    public function deleteproduct()
    {
        global $pdo;

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['Product_ID'])) {
            $productId = $_GET['Product_ID'];

            try {
                // Perform the deletion
                $query = $pdo->prepare("DELETE FROM product WHERE Product_ID = :Product_ID");
                $query->execute(['Product_ID' => $productId]);

                // Redirect to the product list after deletion
                header('Location: ../ok/HTML/admin_products.php');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid request.";
        }
    }

    public function processupdate()
    {
        global $pdo;

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
                header('Location: ../ok/HTML/admin_products.php');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid request.";
        }
    }

    public function readcartProducts()
    {
        global $pdo;
        try {
            $query = $pdo->query("SELECT * FROM product");
            $query1 = $pdo->query("SELECT * FROM cart_items");
            $items = $query1->fetchAll(PDO::FETCH_ASSOC);
            $products = $query->fetchAll(PDO::FETCH_ASSOC);
            global $tot;
            $tot = 0;
            if ($items) {
                foreach ($items as $item) {
                    foreach ($products as $product) {
                        if ($item['Product_ID'] == $product['Product_ID']) {
                            $imageData = base64_encode($product['productMedia']);

                            //$imageData = base64_encode($product['productMedia']);


?>
                            <tr class="cart_item">
                                <td class="product-info">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="shop-product-right.html">

                                                <?php
                                                echo '<img src="data:image/jpeg;base64,' . $imageData . '"  class="media-object cart-product-image">';
                                                ?>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="shop-product-right.html"><?php echo $product['productTitle'] ?></a>
                                            </h4>

                                        </div>
                                    </div>
                                </td>
                                <td class="product-price">
                                    <span class="currencies">$</span>
                                    <span class="amount"><?php echo $product['productPrice'] ?></span>
                                </td>
                                <td class="product-quantity">
                                    <div class="quantity">
                                        <p><?php echo $item['Qte'] ?></p>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    <span class="currencies">$</span>
                                    <span class="amount"><?php echo $item['Qte'] * $product['productPrice'] ?></span>
                                </td>
                                <td class="product-remove">
                                    <a href="../../controller/removeproductfromcart.php?id=<?php echo $item['Cart_Item_ID'] ?>" title="Remove this item">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $tot = $tot + ($item['Qte'] * $product['productPrice']); ?>
                <?php
                        }
                    }
                }
                ?>



                <?php
            } else {
                echo "No products found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function readProducts()
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
    public function readfrontProducts()
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
    public function readfrontsingleProducts()
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
    public function removeproductfromcart()
    {
        global $pdo;
        if ($pdo) {
            $id = $_GET['id'];

            try {
                // Perform the deletion
                $query = $pdo->prepare("DELETE FROM cart_items WHERE Cart_Item_ID = :Cart_Item_ID");
                $query->execute(['Cart_Item_ID' => $id]);  // Corrected parameter name

                // Redirect to the product list after deletion
                header('Location: ../ok/HTML/shop-cart-right.php');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    public function updateProduct()
    {
        global $pdo;

        if ($pdo) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['Product_ID'])) {
                $productId = $_GET['Product_ID'];

                try {
                    $query = $pdo->prepare("SELECT * FROM product WHERE Product_ID = :Product_ID");
                    $query->execute(['Product_ID' => $productId]);
                    $product = $query->fetch(PDO::FETCH_ASSOC);

                    if ($product) {
                        $imageData = base64_encode($product['productMedia']);
                    ?>
                        <!DOCTYPE html>
                        <html lang="en">

                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Update Product</title>
                            <link rel="stylesheet" href="../ok/HTML/css/css/bootstrap.min.css" />
                            <link rel="stylesheet" href="../ok/css/animations.css" />
                            <link rel="stylesheet" href="../ok/HTML/css/fonts.css" />
                            <link rel="stylesheet" href="../ok/HTML/css/main.css" class="color-switcher-link" />
                            <link rel="stylesheet" href="../ok/HTML/css/dashboard.css" class="color-switcher-link" />
                        </head>

                        <body class="admin">

                            <div id="canvas">
                                <div id="box_wrapper">
                                    <header class="page_header_side page_header_side_sticked active-slide-side-header ds">
                                        <div class="side_header_logo ds ms">

                                            <a href="../ok/HTML/admin_products.php">

                                                <span class="logo_text"> Go Back </span>
                                                <div></div>
                                            </a>

                                            <br>
                                            <span class="logo_text">Editing Interface</span>
                                        </div>

                                        <div class="scrollbar-macosx">
                                            <div class="side_header_inner">
                                                <!-- user -->

                                                <div class="user-menu">
                                                    <ul class="menu-click">
                                                        <li>
                                                            <a href="#">
                                                                <div class="media">
                                                                    <div class="media-left media-middle">

                                                                    </div>



                                                                    <div class="media-body media-middle">
                                                                        <h4>Sameur Mkaouar</h4>
                                                                        Administrator
                                                                    </div>
                                                                </div>
                                                            </a>

                                                        </li>
                                                    </ul>
                                                </div>

                                                <!-- main side nav start -->

                                                </nav>
                                                <!-- eof main side nav -->

                                                <div class="with_padding grey text-center">

                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
                                        <div class="container-fluid">
                                            <form method="post" action="processupdate.php" enctype="multipart/form-data">
                                                <input type="hidden" name="Product_ID" value="<?php echo $product['Product_ID']; ?>">
                                                <div class="col-md-8">
                                                    <div class="with_border with_padding">
                                                        <!-- Product Title -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Product Title:</label>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="productTitle" value="<?php echo $product['productTitle']; ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Product Slug -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Product Slug:</label>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="productSlug" value="<?php echo $product['productSlug']; ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Product Price -->
                                                        <div class="row form-group admin-product-price">
                                                            <label class="col-lg-3 control-label">Product Price:</label>
                                                            <div class="col-lg-9">
                                                                <input type="number" step="0.01" class="form-control" name="productPrice" value="<?php echo $product['productPrice']; ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Short Description -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Short description:</label>
                                                            <div class="col-lg-9">
                                                                <textarea rows="3" class="form-control" name="productShortDesc"><?php echo $product['productShortDesc']; ?></textarea>
                                                            </div>
                                                        </div>


                                                        <!-- Product Description -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Product description:</label>
                                                            <div class="col-lg-9">
                                                                <textarea rows="8" class="form-control" name="productDesc"><?php echo $product['productDesc']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="with_border with_padding">
                                                        <!-- Publish Date -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Publish date:</label>
                                                            <div class="col-lg-9">
                                                                <input type="date" class="form-control" name="productPublishDate" value="<?php echo $product['productPublishDate']; ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Publish Time -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Publish time:</label>
                                                            <div class="col-lg-9">
                                                                <input type="time" class="form-control" name="productPublishTime" value="<?php echo $product['productPublishTime']; ?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="with_border with_padding">
                                                        <!-- Categories -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Categories:</label>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="productCategory" value="<?php echo $product['productCategory']; ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Product Tags -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Product Tags:</label>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="productTags" value="<?php echo $product['productTags']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="with_border with_padding">
                                                        <!-- Product Media -->
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Product Media:</label>
                                                            <div class="col-lg-9">
                                                                <?php echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Product Image" style="width: 100px; height: 100px; object-fit: cover;" />'; ?>
                                                                <div></div>
                                                                <input type="file" class="form-control" name="productMedia" value="">

                                                            </div>
                                                        </div>

                                                        <!-- Submit Button -->
                                                        <div class="row">
                                                            <div class="col-sm-12 text-right">
                                                                <button type="submit" class="theme_button wide_button">Update Product</button>
                                                                <!-- Add a cancel button or link if needed -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                            </div>

                        </body>

                        </html>
<?php
                    } else {
                        echo "Product not found.";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Invalid request.";
            }
        } else {
            echo "Error: Unable to connect to the database.";
        }
    }
}
