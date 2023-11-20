<?php

// Instanciation de la classe config
$conf = new config();

class appointment
{
    private string $name;
    private string $email;
    private string $tel;
    private string $age;
    private string $date;
    private string $sex;
    private string $online;
    private string $doc;
    private string $iddoc;

    function listApp()
    {
        // Utilisation de la méthode statique de config
        $db = config::getConnexion();
        try {
            $query = 'SELECT * FROM appoitment ';
            $result = $db->query($query);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    
        echo '<table border="1"><tr><td>Name:</td><td>Email:</td><td>Phone:</td><td>Age:</td><td>Date:</td><td>Sex:</td><td>Type:</td><td>Doctor:</td></tr>';
        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['tel'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['sex'] . '</td>';
            echo '<td>' . $row['online'] . '</td>';
            echo '<td>' . $row['doc'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    
    function listAppForDoctor($iddoc)
    {
        // Utilisation de la méthode statique de config
        $db = config::getConnexion();
        try {
            // Use a prepared statement to prevent SQL injection
            $query = 'SELECT * FROM appoitment WHERE doc = :iddoc';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':iddoc', $iddoc, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    
        echo '<table border="1"><tr><td>Name:</td><td>Email:</td><td>Phone:</td><td>Age:</td><td>Date:</td><td>Sex:</td><td>Type:</td><td>Doctor:</td></tr>';
        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['tel'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['sex'] . '</td>';
            echo '<td>' . $row['online'] . '</td>';
            echo '<td>' . $row['doc'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    
    function addappointment($name, $email, $tel, $age, $date, $sex, $online, $iddoc)
    {
        $db = config::getConnexion();
        try {
            $query = "INSERT INTO appoitment (name, email, tel, age, date, sex, online, doc) VALUES (:name, :email, :tel, :age, :date, :sex, :online, :iddoc)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
            $stmt->bindValue(':age', $age, PDO::PARAM_STR);
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
            $stmt->bindValue(':online', $online, PDO::PARAM_STR);
            $stmt->bindValue(':iddoc', $iddoc, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function deleteappointment($id){
        $sql = "DELETE FROM appoitment WHERE id=:id";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(":id",$id);
        try{
            $req->execute();
        }catch (PDOException $e){
            die('Error:' . $e->getMessage());
    }
}
function getAppInfo($id) {
    $db = config::getConnexion();
    try {
        $query = "SELECT * FROM appoitment WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne les informations du joueur en tant que tableau associatif
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
function updateappointment($id, $nouveauDate, $nouveauemail, $nouveauonline, $nouveautel) {
    $db = config::getConnexion();
    try {
        $query = "UPDATE appoitment SET Date = :Date, email = :email, online = :online, tel = :tel WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':Date', $nouveauDate, PDO::PARAM_STR);
        $stmt->bindParam(':email', $nouveauemail, PDO::PARAM_STR);
        $stmt->bindParam(':online', $nouveauonline, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $nouveautel, PDO::PARAM_STR);

        $stmt->execute();
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
}




?>


