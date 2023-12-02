<?php
include_once(__DIR__ . '/../config.php');
$pdo = config::getConnexion();

if ($pdo) {
    function readProducts()
    {
        global $pdo;

        // Pagination variables
        $recordsPerPage = 5; // Number of records per page
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;

        try {
            $query = $pdo->query("SELECT * FROM cart WHERE Status = 0 LIMIT $offset, $recordsPerPage");
            $carts = $query->fetchAll(PDO::FETCH_ASSOC);

            // Retrieve products
            $productsQuery = $pdo->query("SELECT * FROM product");
            $products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

?>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Order:</th>
                    <th>Customer:</th>
                    <th>Date:</th>
                </tr>
                <?php
                foreach ($carts as $cart) {
                    echo '<tr class="item-editable">';
                    echo '<td class="media-middle">';
                    echo '<div class="media-body">';
                    // Display customer name or link to customer profile (assuming User_ID is the customer ID)
                    echo '<a href="#" data-toggle="modal" data-target="#cartModal' . $cart['Cart_ID'] . '">' . $cart['Cart_ID'] . '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="media">';
                    echo '<div class="media-left">';
                    // You can add customer image or other details here
                    echo '</div>';
                    echo '<div class="media-body">';
                    // Display customer name or link to customer profile (assuming User_ID is the customer ID)
                    echo '<p>' . $cart['User_ID'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td class="media-middle">';
                    // Display the date from the cart (assuming creationDate is the date)
                    echo '<time datetime="' . $cart['creationDate'] . '" class="entry-date">' . $cart['creationDate'] . '</time>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </table>

            <?php
            // Modal outside of the loop
            foreach ($carts as $cart) {
                echo '<div class="modal fade" id="cartModal' . $cart['Cart_ID'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                echo '<div class="modal-dialog" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="exampleModalLabel">Cart Details for Cart ID: ' . $cart['Cart_ID'] . '</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
                echo '<div class="modal-body">';

                // Add your existing code to fetch and display cart details based on $cart['Cart_ID']
                // ... Placeholder code below:

                // Add your existing code here to fetch and display cart details based on $cart['Cart_ID']
                $selectedCartId = $cart['Cart_ID'];
                $queryCartDetails = $pdo->prepare("SELECT * FROM cart_items WHERE Cart_ID = :cartId");
                $queryCartDetails->bindParam(":cartId", $selectedCartId, PDO::PARAM_INT);
                $queryCartDetails->execute();
                $cartDetails = $queryCartDetails->fetchAll(PDO::FETCH_ASSOC);

                if ($cartDetails) {
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Product Title</th>';
                    echo '<th>Quantity</th>';
                    echo '<th>Price</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    foreach ($cartDetails as $item) {
                        foreach ($products as $product) {
                            if ($item['Product_ID'] == $product['Product_ID']) {
                                echo '<tr>';
                                echo '<td>' . $product['productTitle'] . '</td>';
                                echo '<td>' . $item['Qte'] . '</td>';
                                echo '<td>' . ($item['Qte'] * $product["productPrice"]) . '</td>';
                                echo '</tr>';
                            }
                        }
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No items in the cart.</p>';
                }

                // End of placeholder code

                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>

            <!-- Pagination -->
            <ul class="pagination">
                <?php
                $totalPagesQuery = $pdo->query("SELECT COUNT(*) as total FROM cart WHERE Status = 0");
                $totalPages = ceil($totalPagesQuery->fetch(PDO::FETCH_ASSOC)['total'] / $recordsPerPage);

                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<li class="page-item ' . ($currentPage == $i ? "active" : "") . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
            <!-- End of Pagination -->

<?php
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Call the function to show products
    readProducts();
} else {
    echo "Error: Unable to connect to the database.";
}
?>