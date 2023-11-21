<?php
include_once '../config.php';
$pdo = config::getConnexion();
if ($pdo) {
    function readreponse()
    {
        global $pdo;
        try {
            $query = $pdo->query("SELECT * FROM reponse");
            $reponses = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($reponses) {
                foreach ($reponses as $reponse) {
                    echo "<p>Reponse: {$reponse['reponse']}</p>";
                    echo "<hr>";
                }
            } else {
                echo "No tickets found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // Call the function to show ticket

    readreponse();

} else {
    echo "Error: Unable to connect to the database.";
}
?>