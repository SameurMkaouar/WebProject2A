<?php
//include_once(__DIR__ . '/../config.php');
$pdo = config::getConnexion();
if ($pdo) {
    $twentyFourHoursAgo = strtotime('-24 hours');

    // Retrieve new carts
    $cartQuery = $pdo->query("SELECT * FROM cart WHERE Status = 0 AND creationDate > DATE_SUB(NOW(), INTERVAL 24 HOUR) ORDER BY creationDate DESC");
    $carts = $cartQuery->fetchAll(PDO::FETCH_ASSOC);

    $newNotificationsCount = count($carts); // Initialize count based on the fetched carts
?>

    <li class="dropdown header-notes-dropdown">
        <a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
            <i class="fa fa-bell-o grey"></i>
            <span class="header-button-text">Messages</span>
            <span class="header-dropdown-number">
                <?php echo $newNotificationsCount; ?>
            </span>
        </a>

        <div class="dropdown-menu ls">
            <div class="dropdwon-menu-title with_background">
                <strong><?php echo $newNotificationsCount; ?> Pending</strong> Notifications

                <div class="pull-right darklinks">
                    <a href="#">View All</a>
                </div>
            </div>
            <ul class="list-unstyled">
                <?php
                foreach ($carts as $cart) {
                    $cartTimestamp = strtotime($cart['creationDate']);

                    // Check if the cart is within the last 24 hours
                    if ($cartTimestamp > $twentyFourHoursAgo) {
                        // Display notification with the original styling
                ?>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="media with_background">
                                    <div class="media-left media-middle">
                                        <div class="teaser_icon label-danger">
                                            <i class="fa fa-shopping-basket"></i>
                                        </div>
                                    </div>
                                    <div class="media-body media-middle">
                                        <span class="grey">
                                            New order with ID <?php echo $cart['Cart_ID']; ?>
                                        </span>
                                        <span class="pull-right" style="color: #1a1a1a">
                                            <?php
                                            $cartDate = new DateTime($cart['creationDate']);
                                            $currentDate = new DateTime();
                                            $timeAgo = $currentDate->diff($cartDate);
                                            echo $timeAgo->format('%hh, %im ago');
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </li>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalLinks = document.querySelectorAll('.open-ticket-modal');

            modalLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    var ticketId = this.getAttribute('data-ticket-id');
                    $('#admin_contact_modal_' + ticketId).modal('show');
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalLinks = document.querySelectorAll('.open-read-link');

            modalLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    var ticketId = this.getAttribute('data-ticket-id');
                    $('#read_admin_contact_modal_' + ticketId).modal('show');
                });
            });
        });
    </script>

<?php
}
?>