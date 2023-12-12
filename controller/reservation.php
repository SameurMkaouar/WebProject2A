<?php
require_once(__DIR__ . '/../config.php');
include('../../model/reservationmodel.php');

class reservationC
{
public function afficherReservation()
{
    $sql="SELECT * FROM reservation";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
       $e->getMessage();
    }
}

public function supprimerReservation($id)
{
    $sql="DELETE FROM reservation WHERE idreservation=:id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id' , $id);
    try{
        $req->execute();
    }
    catch(Exception $e){
        $e->getMessage();
    }
}
    public function ajouterReservation($reservation){
        $sql = "INSERT INTO reservation (nbplace, paiement, idevent, Id)
            VALUES (:nbplace, :paiement, :idevent, :userid)";
        $db = config::getConnexion();

        try{
            $query = $db->prepare($sql);
            $query->execute([
                'nbplace' => $reservation->getPlace(),
                'paiement' => $reservation->getPaiement(),
                'idevent' => $reservation->getevent(),
                'userid' => $_POST['userid'] // Get user ID from the form
            ]);
        } catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }


public function modifierReservation($id,$reservation)
{
    try{
        $db = config::getConnexion();
        $query = $db->prepare('UPDATE reservation SET nbplace = :place, paiement = :paiement WHERE idreservation = :id');
        $query->execute([
            'place' => $reservation->getPlace(),
            'paiement' => $reservation->getPaiement(),
            'id' => $id
        ]);
    } catch (Exception $e){
        $e->getMessage();
}}
public function recupererReservation($id){
    $sql="SELECT * from reservation where idreservation=:id";
    $db = config::getConnexion();
    try{
        $query = $db->prepare($sql);
        $query->bindValue(':id' , $id);
        $query->execute();
        $rsrv = $query->fetch();
        return $rsrv;
    }catch(Exception $e){
        $e->getMessage();
    }   
}
    public function userReservation($user_id){
        $sql="SELECT * from reservation where Id=:id";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->bindValue(':id' , $user_id);
            $query->execute();
            $rsrv = $query->fetch();
            return $rsrv;
        }catch(Exception $e){
            $e->getMessage();
        }
    }
public function jointureReservation($id)
{
    $sql="SELECT * FROM reservation INNER JOIN event on reservation.idevent = event.idevent WHERE event.idevent = $id";
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
    catch(Exception $e){
        die('Erreur:' . $e->getMessage());
    }
}
public function updateNbrPlace($id,$nbr){
    try{
        $db = config::getConnexion();
        $sql = "UPDATE event SET nbevent = :place WHERE idevent = :id";
        $query = $db->prepare($sql);
        $query->execute([
            'place' => $nbr,
            'id' => $id
        ]);
    }catch(Exception $e){
        die('Erreur:' . $e->getMessage());
    }
}
}
?>