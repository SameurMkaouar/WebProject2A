<?php
include_once '../../config.php';
$pdo = config::getConnexion();
if ($pdo) {
    $query2=$pdo->query("SELECT * FROM users");
    $users=$query2->fetchAll(PDO::FETCH_ASSOC);

    $twentyFourHoursAgo = strtotime('-24 hours');
    $newNotificationsCount = 0;

    // Retrieve new tickets
    $ticketQuery = $pdo->query("SELECT * FROM ticket ORDER BY date DESC");
    $tickets = $ticketQuery->fetchAll(PDO::FETCH_ASSOC);

    // Retrieve new feedbacks
    $feedbackQuery = $pdo->query("SELECT * FROM reponse WHERE feedbacktime > DATE_SUB(NOW(), INTERVAL 24 HOUR) ORDER BY feedbacktime DESC");
    $feedbacks = $feedbackQuery->fetchAll(PDO::FETCH_ASSOC);

    // Combine tickets and feedbacks into a single array
    $notifications = array_merge($tickets, $feedbacks);

    // Sort the combined array by date
    usort($notifications, function ($a, $b) {
        $dateA = isset($a['date']) ? strtotime($a['date']) : strtotime($a['feedbacktime']);
        $dateB = isset($b['date']) ? strtotime($b['date']) : strtotime($b['feedbacktime']);
        return $dateB - $dateA;
    });
$newNotificationsCount = 0;

foreach ($notifications as $notification) {
$notificationTimestamp = isset($notification['date']) ? strtotime($notification['date']) : strtotime($notification['feedbacktime']);

// Check if the notification is within the last 24 hours
if ($notificationTimestamp > $twentyFourHoursAgo) {
    $newNotificationsCount++; }}

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
                <strong><?php echo $newNotificationsCount ?>  Pending</strong> Notifications

                <div class="pull-right darklinks">
                    <a href="#">View All</a>
                </div>
            </div>
            <ul class="list-unstyled">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#tab1" role="tab" data-toggle="tab">Quality</a>
                    </li>
                    <li>
                        <a href="#tab2" role="tab" data-toggle="tab">Comfort</a>
                    </li>
                    <li>
                        <a href="#tab3" role="tab" data-toggle="tab">Results</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi minus tenetur sunt aspernatur vitae, corporis nostrum quibusdam molestias, laudantium quia in a natus facilis beatae culpa inventore quidem illo atque.</p>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, enim saepe libero iure tenetur optio nisi aliquam molestias ratione magnam ab ut quod possimus hic suscipit doloremque, deleniti ipsa quia!</p>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis est, dolores, ex ducimus cumque iusto ipsam odit voluptatum autem error impedit obcaecati quisquam molestiae, optio porro inventore nostrum deleniti cupiditate.</p>
                    </div>
                </div>
                <?php
                foreach ($notifications as $notification) {
                    $notificationTimestamp = isset($notification['date']) ? strtotime($notification['date']) : strtotime($notification['feedbacktime']);

                    // Check if the notification is within the last 24 hours
                    if ($notificationTimestamp > $twentyFourHoursAgo) {
                        $newNotificationsCount++;

                        // Display notification with the original styling
                        ?>
                        <li>
                            <?php
                            if (isset($notification['date'])) {
                                // Ticket
                                $ticketDate = new DateTime($notification['date']);
                                $currentDate = new DateTime();
                                $timeAgo = $currentDate->diff($ticketDate);
                                ?>
                                <a href="javascript:void(0);" class="open-ticket-modal" data-ticket-id="<?php echo $notification['ticketid']; ?>">
                                    <div class="media with_background">
                                        <div class="media-left media-middle">
                                            <div class="teaser_icon label-primary">
                                                <i class="rt-icon2-message"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-middle">
                                            <span class="grey">
                                                New ticket from <?php
                                                foreach ($users as $user) {
                                                    if ($notification['Id'] == $user['Id']) {
                                                        echo $user['Username'];
                                                        break;
                                                    }
                                                }

                                                ?>
                                            </span>
                                            <span class="pull-right" style="color: #1a1a1a"><?php echo $timeAgo->format('%hh, %im ago'); ?></span>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            } elseif (isset($notification['feedbacktime'])) {
                                // Feedback
                                $feedbackDate = new DateTime($notification['feedbacktime']);
                                $currentDate = new DateTime();
                                $timeAgo = $currentDate->diff($feedbackDate);
                                ?>
                                <a href="javascript:void(0);"  class="open-read-link" data-ticket-id="<?php echo $notification['ticketid']; ?>">
                                    <div class="media with_background">
                                        <div class="media-left media-middle">
                                            <div class="teaser_icon label-success">
                                                <i class="rt-icon2-thumbs-up"></i>
                                            </div>
                                        </div>
                                        <div class="media-body media-middle">
                                            <span class="grey">
                                                <?php
                                                foreach ($tickets as $ticket) {
                                                    if ($ticket['ticketid'] == $notification['ticketid']) {
                                                        foreach ($users as $user) {
                                                            if ($ticket['Id'] == $user['Id']) {
                                                                echo  'New feedback from ' . $user['Username'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </span>
                                            <span class="pull-right" style="color: #1a1a1a"><?php echo $timeAgo->format('%hh, %im ago'); ?></span>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                            ?>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </li>

    <script>     
        document.addEventListener("DOMContentLoaded", function () {
            var modalLinks = document.querySelectorAll('.open-ticket-modal');

            modalLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    var ticketId = this.getAttribute('data-ticket-id');
                    $('#admin_contact_modal_' + ticketId).modal('show');
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modalLinks = document.querySelectorAll('.open-read-link');

            modalLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    var ticketId = this.getAttribute('data-ticket-id');
                    $('#read_admin_contact_modal_' + ticketId).modal('show');
                });
            });
        });
    </script>
    <?php
}
?>
