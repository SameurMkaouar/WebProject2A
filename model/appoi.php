<?php

// Instanciation de la classe config
require_once __DIR__ . '/../config.php';

class appointment
{
    
    public function listApp() {
        // Utilisation de la méthode statique de config
        $db = config::getConnexion();
        try {
            $query = 'SELECT * FROM appoitment ';
            $result = $db->query($query);
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    
        
    }
    
    function listAppPendingDoctor($iddoc)
{
    // Utilisation de la méthode statique de config
    $db = config::getConnexion();
    try {
        // Use a prepared statement to prevent SQL injection
        $query = 'SELECT * FROM users
        JOIN appoitment ON users.Id = appoitment.id_patient WHERE appoitment.id_doc = :iddoc AND appoitment.confirmation=0';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':iddoc', $iddoc, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    
}
    function doctorAppOnline($iddoc)
{
    // Utilisation de la méthode statique de config
    $db = config::getConnexion();
    try {
        // Use a prepared statement to prevent SQL injection
        $query = 'SELECT * FROM users
        JOIN appoitment ON users.Id = appoitment.id_patient WHERE appoitment.id_doc = :iddoc AND appoitment.confirmation=1 AND appoitment.type="online"';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':iddoc', $iddoc, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    
}
    function doctorAppIRL($iddoc)
{
    // Utilisation de la méthode statique de config
    $db = config::getConnexion();
    try {
        // Use a prepared statement to prevent SQL injection
        $query = 'SELECT * FROM users
        JOIN appoitment ON users.Id = appoitment.id_patient WHERE appoitment.id_doc = :iddoc AND appoitment.confirmation=1 AND appoitment.type="irl"';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':iddoc', $iddoc, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    
}


function listAppForDoctorPreConfirmation($iddoc)
{
    // Utilisation de la méthode statique de config
    $db = config::getConnexion();
    try {
        // Use a prepared statement to prevent SQL injection
        $query = 'SELECT * FROM appoitment WHERE doc = :iddoc AND confirmation = 0';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':iddoc', $iddoc, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    
}

function listAppForDoctorConfirmed()
{
    // Utilisation de la méthode statique de config
    $db = config::getConnexion();
    try {
        // Utilisation d'une requête préparée pour prévenir les injections SQL
        $query = 'SELECT * FROM appoitment WHERE confirmation = 1';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    
}


function confirmAppointment($appointment_id)
{
    $db = config::getConnexion();
    try {
        $query = "UPDATE appoitment SET confirmation = 1 WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $appointment_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

    public function addappointment($appoint)
    {
        $db = config::getConnexion();
        try {
            $query = "INSERT INTO appoitment (id_patient,id_doc,name,email,date,type) VALUES (:id_p,:id_d,:name, :email,:date, :typ)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':id_p',$appoint['id_p'], PDO::PARAM_STR);
            $stmt->bindValue(':id_d',$appoint['id_d'], PDO::PARAM_STR);
            $stmt->bindValue(':name',$appoint['name'], PDO::PARAM_STR);
            $stmt->bindValue(':email',$appoint['email'], PDO::PARAM_STR);
            $stmt->bindValue(':date',$appoint['date'], PDO::PARAM_STR);
            $stmt->bindValue(':typ',$appoint['type'], PDO::PARAM_STR);
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
public function updateAppointment($id, $newDate, $newEmail, $newOnline, $newTel) {
    $db = config::getConnexion();
    try {
        $query = "UPDATE appoitment SET Date = :date, email = :email, online = :online, tel = :tel WHERE id = :id";
        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $newDate, PDO::PARAM_STR);
        $stmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $stmt->bindParam(':online', $newOnline, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $newTel, PDO::PARAM_STR);

        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
public function getAllAppointments() {
    $db = config::getConnexion();
    try {
        $query = "SELECT * FROM appoitment";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
public function confirmApp($id){
    $db = config::getConnexion();
    try {
        $query = "UPDATE appoitment SET confirmation= 1 WHERE id = :id";
        $stmt = $db->prepare($query);

       
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
       

        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
public function denyApp($id){
    $db = config::getConnexion();
    try {
        $query = "UPDATE appoitment SET confirmation= -1 WHERE id = :id";
        $stmt = $db->prepare($query);

       
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
       

        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
}

?>