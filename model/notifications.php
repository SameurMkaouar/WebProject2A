<?php
require_once __DIR__ . '/../config.php';


class notif{
    public function addRegNotification($notifContent,$doctor_id){
        $db = config::getConnexion();

        $query="INSERT INTO notifications(Content,Doctor_id,Type,Reciever) VALUES(:content,:dctr,:typ,:rec)";

        $req = $db->prepare($query);
        $req->bindValue(":content",$notifContent);
        $req->bindValue(":dctr",$doctor_id);
        $req->bindValue(":typ","registration");
        $req->bindValue(":rec","admin");
        try {
            $req->execute();
            return true; // Insertion successful
        } catch (PDOException $e) {
            return "An error occurred during notif registration. Please try again.";
        }

    }
    public function addPostNotification($notifContent,$post_id){
        $db = config::getConnexion();

        $query="INSERT INTO notifications(Content,Doctor_id,Type,Reciever) VALUES(:content,:dctr,:typ,:rec)";

        $req = $db->prepare($query);
        $req->bindValue(":content",$notifContent);
        $req->bindValue(":dctr",$post_id);
        $req->bindValue(":typ","post");
        $req->bindValue(":rec","admin");
        try {
            $req->execute();
            return true; // Insertion successful
        } catch (PDOException $e) {
            return "An error occurred during notif registration. Please try again.";
        }

    }
    public function addacceptNotification($notifContent,$post_id){
        $db = config::getConnexion();

        $query="INSERT INTO notifications(Content,Doctor_id,Type,Reciever) VALUES(:content,:dctr,:typ,:rec)";

        $req = $db->prepare($query);
        $req->bindValue(":content",$notifContent);
        $req->bindValue(":dctr",$post_id);
        $req->bindValue(":typ","acceptance");
        $req->bindValue(":rec","doctor");
        try {
            $req->execute();
            return true; // Insertion successful
        } catch (PDOException $e) {
            return "An error occurred during notif registration. Please try again.";
        }

    }
    public function getUnreadNotificationsAdmin(){
        $db = config::getConnexion();
        $query="SELECT * FROM notifications WHERE Status=:stat AND Reciever=:admn  ORDER BY Timestamp DESC" ;
        $req = $db->prepare($query);
        $req->bindValue(":stat","unread");
        $req->bindValue(":admn","admin");
        try {
            $req->execute();
            $liste = $req->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getUnreadNotificationsDoc($id){
        $db = config::getConnexion();
        $query="SELECT * FROM notifications WHERE Status=:stat AND Reciever=:doc AND Doctor_id=:id   ORDER BY Timestamp DESC" ;
        $req = $db->prepare($query);
        $req->bindValue(":stat","unread");
        $req->bindValue(":doc","doctor");
        $req->bindValue(":id",$id);
        try {
            $req->execute();
            $liste = $req->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function markNotificationsAsRead($notificationId) {
        try {
            $db = config::getConnexion();
    
            // Prepare the SQL statement
            $query ="UPDATE notifications SET status = 'read' WHERE Notif_id IN (:id)";
            $req = $db->prepare($query);
    
            // Bind parameters
            $req->bindParam(':id',$notificationId );
    
            // Execute the statement
            $req->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function viewall() {
        try {
            $db = config::getConnexion();
    
            // Prepare the SQL statement
            $query ="UPDATE notifications SET status = 'read' WHERE status = :id";
            $req = $db->prepare($query);
    
            // Bind parameters
            $req->bindValue(':id',"unread");
    
            // Execute the statement
            $req->execute();
    
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];
    
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


?>