<?php
//include(__DIR__ . '/../config.php');
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
                                            <button class="quantity-btn minus" data-product-id="<?php echo $product['Product_ID']; ?>">-</button>
                                            <input type="text" class="quantity-input" value="<?php echo $item['Qte']; ?>" readonly />
                                            <button class="quantity-btn plus" data-product-id="<?php echo $product['Product_ID']; ?>">+</button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="currencies">$</span>
                                        <span class="amount subtotal"><?php echo $item['Qte'] * $product['productPrice'] ?></span>
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
                <style>
                    .quantity-btn {
                        background-color: #91d0cc;
                        color: white;
                        border: none;
                        padding: 8px 12px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 14px;
                        margin: 2px;
                        cursor: pointer;
                        border-radius: 4px;
                    }

                    .quantity-input {
                        width: 40px;
                        text-align: center;
                        font-size: 14px;
                        border: 1px solid #ddd;
                        border-radius: 4px;
                        margin: 2px;
                    }
                </style>

                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('.quantity-btn').on('click', function() {
                            var $input = $(this).parent().find('input');
                            var productId = $(this).data('product-id');
                            var oldValue = parseInt($input.val());
                            var operator = $(this).text() === '+' ? 1 : -1;
                            var newValue = oldValue + operator;

                            if (newValue >= 0) {
                                $input.val(newValue);

                                // Update subtotal
                                var price = parseInt($(this).closest('tr').find('.product-price .amount').text());
                                var subtotal = newValue * price;
                                $(this).closest('tr').find('.subtotal').text(subtotal);

                                // Update quantity in the database using AJAX
                                $.ajax({
                                    url: '../../controller/update_quantity.php',
                                    type: 'POST',
                                    data: {
                                        product_id: productId,
                                        new_quantity: newValue
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success) {
                                            console.log('Quantity updated in the database.');
                                        } else {
                                            console.error('Failed to update quantity in the database.');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('AJAX error: ' + error);
                                    }
                                });
                            }
                        });
                    });
                </script>




<?php
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
?>