<?php
require_once('C:\xampp\htdocs\Web\config.php');

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
  

    function listApp() {
        // Utilisation de la méthode statique de config
        $db = config::getConnexion();
        try {
            $query = 'SELECT * FROM appoitment ';
            $result = $db->query($query);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Liste des rendez-vous</title>
            <link rel="stylesheet" href="../../Assets/FrontOffice/css/fonts.css">
        </head>
        <body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-5">
                        <table class="table_template darklinks" border="1">
                            <thead>
                                <tr>
                                    <th style ="padding-right: 140px;">Date:</th>
                                    <th>Type:</th>
                                    <th style ="padding-right: 5px;">Médecin:</th>
                                    <th style ="padding-right: 15px;">Confirmation:</th>
                                    <th colspan="2">Actions:</th>
                                </tr>
                            </thead>
                            <tbody>';
    
        foreach ($result as $row) {
            $date = strtotime($row['date']);
            echo '<tr>';
            echo '<td>' . date('Y-m-d H:i', $date) . '</td>';
            echo '<td>' . $row['online'] . '</td>';
            echo '<td>' . $row['doc'] . '</td>';
    
            if ($row['confirmation'] == 1) {
                echo '<td style="color: #00ff39;"> Confirmé </td>';
                 // Cellule vide pour compenser la colonne des actions
            } else {
                echo '<td style="color: red;"> non Confirmé </td>';
                echo '<td>
                        <form method="post" action="..\deleteappointment.php">
                            <input type="hidden" name="appointment_id" value="' . $row['id'] . '">
                            <button class="theme_button color1" type="submit">Supprimer</button>
                        </form>
                      </td>';
    
                echo '<td>
                        <form method="post" action="../FrontOffice/updateappointment.php">
                            <input type="hidden" name="appointment_id" value="' . $row['id'] . '">
                            <button class="theme_button color1" type="submit" name="update">Modifier</button>
                        </form>
                      </td>';
            }
    
            echo '</tr>';
        }
        echo '</tbody></table>
            </div>
        </div>
        </div>
        </body>
        </html>';
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

    echo '<table class="table_template" border="1">
        <thead>
            <tr>
                <th style="padding-right: 300px;">Date:</th>
                <th style="padding-right: 300px;">Type:</th>
                <th style="padding-right: 250px;">Confirmation:</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($result as $row) {
        $date = strtotime($row['date']);
        echo '<tr>';
        echo '<td>' . date('Y-m-d H:i', $date) . '</td>';
        echo '<td>' . $row['online'] . '</td>';
        if ($row['confirmation'] == 1) {
            echo '<td style="color: #00ff39;"> Confirmé </td>';
        } else {
            echo '<td style="color: red;"> non Confirmé </td>';
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
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
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    
        echo '<table class="table_template darklinks" border="1">
            <thead>
                <tr>
                    <th>Nom:</th>
                    <th>Email:</th>
                    <th>Téléphone:</th>
                    <th>Age:</th>
                    <th>Date:</th>
                    <th>Sexe:</th>
                    <th>Type:</th>
                    <th>Actions:</th>
                </tr>
            </thead>
            <tbody>';
    
        foreach ($result as $row) {
            $date = strtotime($row['date']);
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['tel'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . date('Y-m-d H:i', $date) . '</td>';
            echo '<td>' . $row['sex'] . '</td>';
            echo '<td>' . $row['online'] . '</td>';
         
            echo '<td>
                    <form method="post" action="medecins.php">
                        <input type="hidden" name="appointment_id" value="' . $row['id'] . '">
                        <button class="theme_button color1" type="submit" name="confirm">Confirmer</button>
                        <button class="theme_button color1" type="submit" name="delete">Supprimer</button>
                    </form>
                  </td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
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
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    echo '
    <table class="table_template darklinks" border="1">
        <thead>
            <tr>
                <th>Nom:</th>
                <th>Email:</th>
                <th>Téléphone:</th>
                <th>Age:</th>
                <th>Date:</th>
                <th>Sexe:</th>
                <th>Type:</th>
                <th>Confirmation:</th>
                <th>Actions:</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($result as $row) {
        $date = strtotime($row['date']);
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['tel'] . '</td>';
        echo '<td>' . $row['age'] . '</td>';
        echo '<td>' . date('Y-m-d H:i', $date) . '</td>';
        echo '<td>' . $row['sex'] . '</td>';
        echo '<td>' . $row['online'] . '</td>';
        if ($row['confirmation'] == 1){
            echo '<td style="color: #00ff39;"> Confirmé </td>';
        } else {
            echo '<td style="color: red;"> non Confirmé </td>';
        }
        echo '<td>
        <form method="post">
        <input type="hidden" name="appointment_id" value="' . $row['id'] . '">
        <button class="theme_button color1" type="submit" name="add_ordonnance" formaction="AjouterOrdonnance.php">Ajouter une Ordonnance</button>
        <button class="theme_button color1" type="submit" name="show_details" formaction="AfficherOrd.php">Afficher les détails</button>
    </form>
    
              </td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
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
}




?>


