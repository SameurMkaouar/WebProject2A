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
            global $tot;
            $tot = 0;
            if ($items) {
                foreach ($items as $item) {
                    foreach ($products as $product) {
                        foreach ($carts as $cart) {
                            if ($item['Product_ID'] == $product['Product_ID'] && $cart['Cart_ID'] == $item['Cart_ID'] && $cart['Status'] == 1) {
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
    ?>

<?php
    // Call the function to show products
    readProducts();
} else {
    echo "Error: Unable to connect to the database.";
}
