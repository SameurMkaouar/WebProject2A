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
            $query1 = $pdo->query("SELECT * FROM cart_items");
            $query2 = $pdo->query("SELECT * FROM cart");
            $carts = $query2->fetchAll(PDO::FETCH_ASSOC);
            $items = $query1->fetchAll(PDO::FETCH_ASSOC);
            $products = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($items) {
                echo '<div class="row vertical-tabs">';
                echo '<div class="col-sm-5">';
                echo '<ul class="nav" role="tablist">';

                foreach ($carts as $index => $cart) {
                    if ($cart['Status'] == 0) {
                        $tabIndex = $index + 1;
                        echo '<li class="' . ($tabIndex === 1 ? 'active' : '') . '">';
                        echo '<a href="#vertical-tab' . $tabIndex . '" role="tab" data-toggle="tab">Order Number ' . $cart['Cart_ID'] . '</a>';
                        echo '</li>';
                    }
                }

                echo '</ul>';
                echo '</div>';
                echo '<div class="col-sm-7">';
                echo '<div class="tab-content no-border">';

                foreach ($carts as $index => $cart) {
                    if ($cart['Status'] == 0) {
                        $tabIndex = $index + 1;
                        echo '<div class="tab-pane fade' . ($tabIndex === 1 ? ' in active' : '') . '" id="vertical-tab' . $tabIndex . '">';
                        echo '<h3>Order Details</h3>';

                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Product Title</th>';
                        echo '<th>Quantity</th>';
                        echo '<th>Price</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        foreach ($items as $item) {
                            foreach ($products as $product) {
                                if ($item['Product_ID'] == $product['Product_ID'] && $cart['Cart_ID'] == $item['Cart_ID'] && $cart['Status'] == 0) {
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
                        echo '</div>';
                    }
                }

                echo '</div>';
                echo '</div>';
                echo '</div>';
            } else {
                echo "No products found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



?>

    <?php
    // Call the function to show products
    readProducts();
} else {
    echo "Error: Unable to connect to the database.";
}
