<?php
include_once '../config.php';

$pdo = config::getConnexion();

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
?>
                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Update Product</title>
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

// Call the function to update a product
updateProduct();
header('Location: readproduct.php'); ?>