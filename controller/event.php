<?php
require_once(__DIR__ . '/../config.php');

class event {
    public function listevent()
    {
        $db = config::getConnexion();
        try {
            $query = $db->prepare('SELECT * FROM event');
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }
    }

    public function addevent($nomevent, $nbevent, $descriptionevent, $img,$location,$date,$prix)
{
    $pdo = config::getConnexion();

    try {
        $query = $pdo->prepare('INSERT INTO event (nomevent, nbevent, `descriptionevent`,location, image,dateevent,prix) VALUES (:nomevent, :nbevent, :descriptionevent,:loc, :img, :dateevnt, :prix)');
        $query->bindParam(':nomevent', $nomevent);
        $query->bindParam(':nbevent', $nbevent);
        $query->bindParam(':descriptionevent', $descriptionevent);
        $query->bindParam(':loc', $location);
        $query->bindParam(':dateevnt', $date);
        $query->bindParam(':img', $img);
        $query->bindParam(':prix', $prix);
        $query->execute();
        echo '<script type="text/javascript">
                window.location = "./backview.php";
              </script>';
        exit();
    } catch (PDOException $e) {
        echo 'Erreur lors de l\'ajout de l\'événement : ' . $e->getMessage();
        return false;
    }
}

    public function deleteevent($nomevent)
    {
        $db = config::getConnexion();
        try {
            $query = $db->prepare('DELETE FROM event WHERE nomevent = :nomevent');
            $query->execute(['nomevent' => $nomevent]);
        } catch (PDOException $e) {
            echo 'Erreur lors de la suppression de l\'événement : ' . $e->getMessage();
        }
    }

    public function afficherevent($id)
    {
        $db = config::getConnexion();
        try {
            $query = $db->prepare('SELECT * FROM event WHERE idevent = :id');
            $query->execute(['id' => $id]);
            $result = $query->fetch();
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'affichage de l\'événement : ' . $e->getMessage();
        }
    }

 public function updateevent($id, $description, $nb, $new_name,$loc,$date,$prix)
 {
    $db = config::getConnexion();
    try {
        $query = $db->prepare(
            'UPDATE event SET nomevent = :new_name, descriptionevent = :description, nbevent = :nb, dateevent = :date, location=:location, prix=:prix WHERE idevent = :id'
        );
        $query->execute([
            'id' => $id,
            'description' => $description,
            'nb' => $nb,
            'date' => $date,
            'location' => $loc,
            'new_name' => $new_name, // Modifier "new_name" en "new_name"
            'prix' => $prix
        ]);
        echo '<script type="text/javascript">
                window.location = "./backview.php";
              </script>';
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
 }
 public function paginationLIMIT($sql)
    {
            $db = config::getConnexion();
            try {
                $liste = $db->query($sql);
                return $liste;
            } catch (Exception $e) {
                die('Error:' . $e->getMessage());
            }
    }  

    public function paginationCOUNTER($sql)
    {
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $row=$liste->fetch(PDO::FETCH_NUM);
            $total=$row[0];
            return $total;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    } 

    public function verifEmail($email)
    {
        $sql="SELECT * from patient where email=:email";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->bindValue(':email' , $email);
            $query->execute();
            if($query->rowCount() != 1)
            {
                return false;
            }
            else{
                return true;
            }
        }catch(Exception $e){
            $e->getMessage();
        }
    }
    
}
?>