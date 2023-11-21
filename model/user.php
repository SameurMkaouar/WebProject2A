<?php
require_once __DIR__ . '/../config.php';


class user
{
   
    function adduser ($j){
        $db=config::getConnexion();
        $query="INSERT into users(Firstname,Lastname,Username,Email,Sex,DateOfBirth,Password) VALUES(:Firstname, :Lastname,:Username,:Email,:Sex,:DateOfBirth,:Password)";
        $req=$db->prepare($query);
        $req->bindValue(":Firstname",$j['firstname']);
        $req->bindValue(":Lastname",$j['lastname']);
        $req->bindValue(":Username",$j['username']);
        $req->bindValue(":Email",$j['email']);
        $req->bindValue(":Sex",$j['sex']);
        $req->bindValue(":DateOfBirth",$j['DoB']);
        $req->bindValue(":Password",$j['password']);

        try{
            $req->execute();
            //echo "lol";
        }catch (PDOException $e) {
            echo "bob";
        }
}

function listusers()
{
        $db=config::getConnexion();
        try {
            $query="SELECT * FROM users";
            $liste=$db->query($query);
            echo 'cobon';
            return $liste;
    } catch (PDOException $e) {
        echo "bob";
    }
}
function deleteuser ($id){
    $db=config::getConnexion();
    
        $query="DELETE FROM users WHERE Id=:id";
        $req=$db->prepare($query);
        $req->bindValue(":id",$id);
    try{
        $req->execute();
        echo "cava";

    }catch (PDOException $e) {
        echo "bob";
    }
}

public function get_last_inserted_id() {
    $db = config::getConnexion();
    $query = "SELECT LAST_INSERT_ID() as last_id";
    $result = $db->query($query);
    $lastId = $result->fetch(PDO::FETCH_ASSOC)['last_id'];
    return $lastId;
}

public function authentication($email, $enteredPassword)
{
    $db = config::getConnexion();
    $query = "SELECT * FROM users WHERE Email=:email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);

    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if a user with the provided email exists
        if ($result) {
            // Verify the entered password against the stored hashed password
            $storedHashedPassword = $result[0]['Password']; // Assuming 'Password' is the column in your users table

            if (password_verify($enteredPassword, $storedHashedPassword) || $enteredPassword==$storedHashedPassword ) {
                // Passwords match, return the user data
                return $result;
            }
        }

        // No user found or password doesn't match
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

public function retrieveInformation($id) {
    $db = config::getConnexion();
    try {
        $query = "SELECT * FROM users WHERE Id = :id";
        $req = $db->prepare($query);
        $req->bindValue(":id", $id);
        $req->execute();
        $liste = $req->fetchAll(PDO::FETCH_ASSOC);

        // Return the result for further processing
        return $liste;
    } catch (PDOException $e) {
        // Handle the error appropriately, log it, display a message, etc.
        // Return an empty array or any other value indicating failure
        return [];
    }
}


}

?>