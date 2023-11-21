<?php
include_once '../config.php';

$pdo = config::getConnexion();

<<<<<<< HEAD

=======
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
function updateProduct()
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
<<<<<<< HEAD
                    $imageData = base64_encode($product['productMedia']);
=======
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
?>
                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Update Product</title>
<<<<<<< HEAD
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

=======
                        <link rel="stylesheet" href="../themeforest-OjBoMxIv-psychologist-personal-singlemulti-page-html-template-with-page-builder-and-admin-pages/HTML/css/css/bootstrap.min.css" />
                        <link rel="stylesheet" href="../themeforest-OjBoMxIv-psychologist-personal-singlemulti-page-html-template-with-page-builder-and-admin-pages/HTML/css/animations.css" />
                        <link rel="stylesheet" href="../themeforest-OjBoMxIv-psychologist-personal-singlemulti-page-html-template-with-page-builder-and-admin-pages/HTML/css/fonts.css" />
                        <link rel="stylesheet" href="../themeforest-OjBoMxIv-psychologist-personal-singlemulti-page-html-template-with-page-builder-and-admin-pages/HTML/css/main.css" class="color-switcher-link" />
                        <link rel="stylesheet" href="../themeforest-OjBoMxIv-psychologist-personal-singlemulti-page-html-template-with-page-builder-and-admin-pages/HTML/css/dashboard.css" class="color-switcher-link" />
                    </head>

                    <body>
                        <form method="post" action="processupdate.php">
                            <input type="hidden" name="Product_ID" value="<?php echo $product['Product_ID']; ?>">

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

                            <!-- Product Media -->
                            <div class="row form-group">
                                <label class="col-lg-3 control-label">Product Media:</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control" name="productMedia" value="<?php echo $product['productMedia']; ?>">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="theme_button wide_button">Update Product</button>
                                    <!-- Add a cancel button or link if needed -->
                                </div>
                            </div>
                        </form>
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
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

<<<<<<< HEAD


updateProduct();



?>
=======
// Call the function to update a product
updateProduct();
header('Location: readproduct.php'); ?>
>>>>>>> 9c10d6a704077fbbc08e24bd8bd0b797fab619a2
