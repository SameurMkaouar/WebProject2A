<?php
//include(__DIR__ . '/../config.php');
//include 'updateproduct.php';

$pdo = config::getConnexion();

if ($pdo) {
    function readProducts()
    {
        global $pdo;
        global $cart;
        try {
            $query = $pdo->query("SELECT * FROM product");
            $query1 = $pdo->query("SELECT * FROM cart_items");
            $query2 = $pdo->query("SELECT * FROM cart");
            $carts = $query2->fetchAll(PDO::FETCH_ASSOC);
            $items = $query1->fetchAll(PDO::FETCH_ASSOC);
            $products = $query->fetchAll(PDO::FETCH_ASSOC);
            global $tot;
            $tot = 0;
?>
            <div id="order_review" class="shop-checkout-review-order">
                <table class="table shop_table shop-checkout-review-order-table">
                    <thead>
                        <tr>
                            <td class="product-name">Product</td>
                            <td class="product-total">Total</td>
                        </tr>

                        <?php
                        if ($items) {
                            foreach ($items as $item) {
                                foreach ($products as $product) {
                                    foreach ($carts as $cart) {
                                        if ($item['Product_ID'] == $product['Product_ID'] && $cart['Cart_ID'] == $item['Cart_ID'] && $cart['Status'] == 1) {
                                            $imageData = base64_encode($product['productMedia']);

                                            //$imageData = base64_encode($product['productMedia']);


                        ?>

                    </thead>
                    <tbody>
                        <tr class="cart_item">
                            <td class="product-name">
                                <?php echo $product['productTitle'] ?>
                                <span class="product-quantity">×<?php echo $item['Qte'] ?></span>
                            </td>
                            <td class="product-total">
                                <span class="currencies">$</span>
                                <span class="amount"><?php echo $item['Qte'] * $product['productPrice'] ?> </span>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>




                        <?php $tot = $tot + ($item['Qte'] * $product['productPrice']); ?>
        <?php
                                        }
                                    }
                                }
                            }
        ?>

        <tr class="shipping">
            <td>Shipping:</td>
            <td>
                <span class="grey">$ 10</span>
            </td>
        </tr>

        <tr class="order-total">
            <td>Total:</td>
            <td>
                <span class="amount grey">
                    <strong>$<?php echo " " . $tot + 10 ?></strong>
                </span>
            </td>
        </tr>
                    </tfoot>
                </table>
            </div>



<?php
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
