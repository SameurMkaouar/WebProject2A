<?php
include_once '../../config.php';
$pdo = config::getConnexion();
if ($pdo) {
    $query = $pdo->query("SELECT * FROM ticket ORDER BY date DESC");
    $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

    $twentyFourHoursAgo = strtotime('-24 hours');
    $newMessagesCount = 0;

    $query2 = $pdo->query("SELECT * FROM users");
    $users = $query2->fetchAll(PDO::FETCH_ASSOC);

?>

    <li class="dropdown header-notes-dropdown">
        <a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
            <i class="fa fa-envelope-o grey"></i>
            <span class="header-button-text">Inbox</span>
            <span class="header-dropdown-number">
                <?php
                foreach ($tickets as $ticket) {
                    // Convert database date to timestamp
                    $ticketTimestamp = strtotime($ticket['date']);

                    // Check if the ticket is within the last 24 hours
                    if ($ticketTimestamp > $twentyFourHoursAgo) {
                        $newMessagesCount++;
                    }
                }
                echo $newMessagesCount;
                ?>
            </span>
        </a>

        <div class="dropdown-menu ls">
            <div class="dropdwon-menu-title with_background">
                <strong><?php echo $newMessagesCount ?> New</strong> Messages

                <div class="pull-right darklinks">
                    <a href="../view/admin_tickets.php">View All</a>
                </div>
            </div>

            <ul class="list1 no-bullets no-top-border no-bottom-border">
                <?php
                foreach ($tickets as $ticket) {
                    // Convert database date to timestamp
                    $ticketTimestamp = strtotime($ticket['date']);

                    // Check if the ticket is within the last 24 hours
                    if ($ticketTimestamp > $twentyFourHoursAgo) {
                ?>
                        <li class="btn-default">
                            <a href="javascript:void(0);" class="open-ticket-modal" data-ticket-id="<?php echo $ticket['ticketid']; ?>">
                                <div class="media">

                                    <div class="media-left" style="width: 100px;">
                                        <?php foreach ($users as $user) {
                                            if ($ticket['Id'] == $user['Id']) {
                                                displayPictureMsg($user['Picture'], 40, "rounded-circle");
                                            }
                                        } ?>
                                    </div>

                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <?php foreach ($users as $user) {
                                                if ($ticket['Id'] == $user['Id']) {
                                                    echo $user['Username'];
                                                    break;
                                                }
                                            } ?>
                                            <span class="pull-right">
                                                <?php
                                                $datetime = new DateTime($ticket['date']);
                                                $formattedDate = $datetime->format('j M \a\t H:i');
                                                echo $formattedDate;
                                                ?>
                                            </span>
                                        </h5>
                                        <div style="color: #1a1a1a">
                                            <?php echo $ticket['message'] ?>
                                        </div>
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

<?php
}
?>
<script>
    // Add this script at the end of your first code snippet
    document.addEventListener("DOMContentLoaded", function() {
        // Select all elements with the class 'open-ticket-modal'
        var modalLinks = document.querySelectorAll('.open-ticket-modal');

        // Add a click event listener to each modal link
        modalLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                // Get the ticket ID from the data attribute
                var ticketId = this.getAttribute('data-ticket-id');

                // Open the modal on admin_tickets.php with the ticket ID
                $('#admin_contact_modal_' + ticketId).modal('show');
            });
        });
    });
</script>