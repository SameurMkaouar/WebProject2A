<?php
include(__DIR__ . '/../config.php');

$pdo = config::getConnexion();

if ($pdo) {
    try {
        $columnMap = array(
            'date' => 'productPublishDate',
            'price' => 'productPrice',
            'title' => 'productTitle'
        );
        ///DONT TOUCH THIS CODE PLEASE 
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'date';
        $orderColumn = isset($columnMap[$orderby]) ? $columnMap[$orderby] : 'productPublishDate';

        // Change default ordering to 'ASC' for the title column
        $orderColumn = ($orderby === 'title') ? 'productTitle' : $orderColumn;

        $orderDirection = ($orderColumn === 'productTitle') ? 'ASC' : 'DESC';

        $showcount = isset($_GET['showcount']) ? $_GET['showcount'] : 5;
        $showcount = in_array($showcount, array(5, 10, 20, 30, 50)) ? $showcount : 5;

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Get the total number of records
        $totalRecordsQuery = $pdo->prepare("SELECT COUNT(*) as total FROM product WHERE productTitle LIKE :search");
        $totalRecordsQuery->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $totalRecordsQuery->execute();
        $totalRecords = $totalRecordsQuery->fetch(PDO::FETCH_ASSOC)['total'];

        // Calculate total pages
        $totalPages = ceil($totalRecords / $showcount);

        // Get current page
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $currentPage = max(1, min($totalPages, $currentPage));

        // Calculate the offset for the SQL query
        $offset = ($currentPage - 1) * $showcount;

        // Retrieve products for the current page
        $query = $pdo->prepare("SELECT * FROM product WHERE productTitle LIKE :search ORDER BY $orderColumn $orderDirection LIMIT $showcount OFFSET $offset");
        $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($products) {
            foreach ($products as $product) {
                $imageData = base64_encode($product['productMedia']);
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

            // Add pagination links to the bottom of the table
            echo '<tr><td colspan="7" class="text-center"><ul class="pagination">';
            for ($i = 1; $i <= $totalPages; $i++) {
                $active = ($i == $currentPage) ? 'class="active"' : '';
                echo "<li $active><a href='?page=$i&orderby=$orderby&showcount=$showcount&search=$search'>$i</a></li>";
            }
            echo '</ul></td></tr>';
        } else {
            echo "<tr><td colspan='7'>No products found.</td></tr>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: Unable to connect to the database.";
}
?>