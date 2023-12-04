<?php
require_once 'C:\xampp\htdocs\si samer\WebProject2A\config.php';

// Instanciation de la classe config
$conf = new config();

class appointment
{
    // ... (autres fonctions de la classe)

    function listAppointmentsWithOrdonance()
    {
        $db = config::getConnexion();
        try {
            $query = "SELECT a.name, a.date, a.doc, o.description
                      FROM appoitment a
                      LEFT JOIN ordonance o ON a.id = o.id_appoitment";

            $result = $db->query($query);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        echo '<table border="1"><tr><td>Name:</td><td>Date:</td><td>Doctor:</td><td>Description:</td></tr>';
        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['doc'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    // ... (autres fonctions de la classe)
}

class Ordonance
{
    
    public function getOrdonanceByPatientId($id) {
        $db = config::getConnexion();
        try {
            $query = "SELECT o.id_ord, o.description, a.name, a.date, a.doc 
                      FROM ordonance o 
                      INNER JOIN appoitment a ON o.id_appoitment = a.id 
                      WHERE a.id = :patient_id";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':patient_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function getOrdonanceInfo($id_ord)
    {
        $db = config::getConnexion();
        try {
            $query = "SELECT o.id_ord, o.description, a.name, a.date, a.doc 
                      FROM ordonance o 
                      INNER JOIN appoitment a ON o.id_appoitment = a.id 
                      WHERE o.id_ord = :id_ord";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_ord', $id_ord, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    // Méthode pour ajouter une nouvelle ordonnance
function addOrdonance($id_ord, $description, $id_appoitment) {
    $db = config::getConnexion();
    try {
        $query = "INSERT INTO ordonance (id_ord, description, id_appoitment) VALUES (:id_ord, :description, :id_appoitment)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_ord', $id_ord, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id_appoitment', $id_appoitment, PDO::PARAM_INT);

        $stmt->execute();
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
// Méthode pour mettre à jour une ordonnance
function updateOrdonance($id_ord, $newDescription, $newIdAppoitment) {
    $db = config::getConnexion();
    try {
        $query = "UPDATE ordonance SET description = :newDescription, id_appoitment = :newIdAppoitment WHERE id_ord = :id_ord";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_ord', $id_ord, PDO::PARAM_INT);
        $stmt->bindParam(':newDescription', $newDescription, PDO::PARAM_STR);
        $stmt->bindParam(':newIdAppoitment', $newIdAppoitment, PDO::PARAM_INT);

        $stmt->execute();
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
// Méthode pour supprimer une ordonnance
function deleteOrdonance($id_ord) {
    $db = config::getConnexion();
    try {
        $query = "DELETE FROM ordonance WHERE id_ord = :id_ord";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_ord', $id_ord, PDO::PARAM_INT);

        $stmt->execute();
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}




    // ... (autres fonctions de la classe)
}
?>
