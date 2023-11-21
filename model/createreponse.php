    <?php
    include_once '../config.php';

    $pdo = config::getConnexion();
    if ($pdo) {
        function Createreponse()
        {
            global $pdo;
            $id = $_GET['id'];
            try {
                $query = $pdo->prepare("INSERT INTO reponse (reponse, ticketid) VALUES (:reponse, :ticketid)");
                $query->execute([
                    'reponse' => $_POST['reponse'],
                    'ticketid' => $id,
                ]);
                echo "Reply sent!";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Createreponse();
            header('Location: ../view/admin_tickets.php');
        }
    } else {
        echo "Error: Unable to connect to the database.";
    }
    ?>