<?php
//include_once(__DIR__ . '/../config.php');


$pdo = config::getConnexion();

if ($pdo) {
    function readProducts()
    {
        global $pdo;
        try {

            //$query = $pdo->query("SELECT * FROM product");
            //$products = $query->fetchAll(PDO::FETCH_ASSOC);

            // Default values
            $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'productPrice-desc';
            $showcount = in_array(($sc = isset($_GET['showcount']) ? $_GET['showcount'] : 6), [6, 12, 18, 24, 30, 36]) ? $sc : 6;
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            // Get the total number of records
            $totalRecordsQuery = $pdo->prepare("SELECT COUNT(*) as total FROM product WHERE productTitle LIKE :search");
            $totalRecordsQuery->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $totalRecordsQuery->execute();
            $totalRecords = $totalRecordsQuery->fetch(PDO::FETCH_ASSOC)['total'];

            // Calculate total pages
            $totalPages = ceil($totalRecords / $showcount);

            // Get current page
            $currentPage = max(1, min($totalPages, isset($_GET['page']) ? $_GET['page'] : 1));

            // Map column names
            $orderColumn = isset($columnMap[$orderby]) ? $columnMap[$orderby] : 'productPrice';
            $orderColumn = ($orderby === 'title') ? 'productTitle' : $orderColumn;

            // Calculate the offset for the SQL query
            $offset = ($currentPage - 1) * $showcount;

            // Determine sorting order
            $orderDirection = (strpos($orderby, '-desc') !== false) ? 'DESC' : 'ASC';


            // Retrieve products for the current page
            $query = $pdo->prepare("SELECT * FROM product WHERE productTitle LIKE :search ORDER BY $orderColumn $orderDirection LIMIT $showcount OFFSET $offset");
            $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $query->execute();
            $products = $query->fetchAll(PDO::FETCH_ASSOC);



            if ($products) {
                foreach ($products as $product) {

                    $imageData = base64_encode($product['productMedia']);

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

                                        </a>

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

                // Add pagination links to the bottom of the table
                echo '<tr><td colspan="7" class="text-center"><ul class="pagination">';
                for ($i = 1; $i <= $totalPages; $i++) {
                    $active = ($i == $currentPage) ? 'class="active"' : '';
                    echo "<li $active><a href='?page=$i&orderby=$orderby&showcount=$showcount&search=$search'>$i</a></li>";
                }
                echo '</ul></td></tr>';
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
