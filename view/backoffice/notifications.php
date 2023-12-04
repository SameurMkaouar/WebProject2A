<?php
include_once('../../config.php');
$pdo = config::getConnexion();
if ($pdo) {
    $twentyFourHoursAgo = strtotime('-24 hours');
    $newNotificationsCount = 0;

    // Retrieve new tickets
    $query = "
        SELECT r.*, e.nomevent
        FROM reservation r
        JOIN event e ON r.idevent = e.idevent
        ORDER BY r.dateRes DESC
    ";
    $ticketQuery = $pdo->query($query);
    $tickets = $ticketQuery->fetchAll(PDO::FETCH_ASSOC);

    // Combine tickets into a single array
    $notifications = $tickets;

    // Sort the combined array by dateRes
    usort($notifications, function ($a, $b) {
        $dateA = isset($a['dateRes']) ? strtotime($a['dateRes']) : 0;
        $dateB = isset($b['dateRes']) ? strtotime($b['dateRes']) : 0;
        return $dateB - $dateA;
    });

    $newNotificationsCount = 0;

    foreach ($notifications as $notification) {
        $notificationTimestamp = isset($notification['dateRes']) ? strtotime($notification['dateRes']) : 0;

        // Check if the notification is within the last 24 hours
        if ($notificationTimestamp > $twentyFourHoursAgo) {
            $newNotificationsCount++;
        }
    }
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
                <?php
                foreach ($notifications as $notification) {
                    $date = strtotime($notification['dateRes']);

                    // Check if the notification is within the last 24 hours
                        if($date > $twentyFourHoursAgo){
                        ?>
                        <li>
                            <a href="javascript:void(0);" class="open-ticket-modal" data-ticket-id="<?php echo $notification['idreservation']; ?>">
                                <div class="media with_background">
                                    <div class="media-left media-middle">
                                        <div class="teaser_icon label-warning" >
                                            <i class="fa fa-calendar-check-o" ></i>
                                        </div>
                                    </div>
                                    <div class="media-body media-middle">
                                        <span class="grey">
                                           <strong> New Booking to 
                                           <?php echo $notification['nomevent']; ?>
                                           </strong>
                                        </span>
                                        <span class="pull-right" style="color: #1a1a1a"><?php echo $notification['dateRes'] ?></span>
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
    <?php
}
?>
