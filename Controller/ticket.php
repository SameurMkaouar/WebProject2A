<?php
include_once '../config.php';
$pdo = config::getConnexion();
if ($pdo) {
    function readticket()
    {
        global $pdo;
        try {
            $query = $pdo->query("SELECT * FROM ticket");
            $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

            $query = $pdo->query("SELECT * FROM reponse");
            $reponses = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($tickets) {
                foreach ($tickets as $ticket) {
                    // Display each ticket information in the left part
                    echo "<div style='float: left; width: 50%;'>";
                    echo "<p>Subject: {$ticket['subject']}</p>";
                    echo "<p>Message: {$ticket['message']}</p>";
                    echo "<p>Date: {$ticket['date']}</p>";

                    // Add link for updating the ticket
                    echo "<p><a href='../model/updatemoods.php?ticketid={$ticket['ticketid']}'>Update</a></p>";

                    // Delete link
                    echo "<p><a href='../model/deleteticket.php?ticketid={$ticket['ticketid']}'>Delete</a></p>";

                    echo "</div>";

                    // Right part for replies
                    echo "<div style='float: right; width: 40%;'>";
                    foreach ($reponses as $reponse) {
                        if ($reponse['ticketid'] == $ticket['ticketid']) {
                            if ($reponse['reponse'] != null) {
                                echo "<p>Reply: {$reponse['reponse']}</p>";
                            } else {
                                echo "<p>Reply: No reply yet</p>";
                            }
                        }
                    }
                    echo "</div>";

                    // Horizontal line to separate tickets
                    echo "<hr style='clear: both;'>";
                }
            }

         else {
                echo "No tickets found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // Call the function to show ticket

    readticket();

} else {
    echo "Error: Unable to connect to the database.";
}
?>