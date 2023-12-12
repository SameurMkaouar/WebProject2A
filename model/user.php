<?php
require_once __DIR__ . '/../config.php';


class user
{
   
    public function adduser($user, $isDoctor = false)
    {
        $db = config::getConnexion();

        // Check if the email is unique
        if (!$this->isEmailUnique($user['email'])) {
            // Email is not unique, return an error message
            return "Email is already in use. Please choose a different email.";
        }

        // Check if the username is unique
        if (!$this->isUsernameUnique($user['username'])) {
            // Username is not unique, return an error message
            return "Username is already taken. Please choose a different username.";
        }

        // Both email and username are unique, proceed with the insertion
        $query = "INSERT INTO users (Firstname, Lastname, Username, Email, Sex, DateOfBirth, Password";

        // Additional fields for doctor registration
        if ($isDoctor) {
            $query .= ", Role, Region, City, Street, PostalCode, Status";
        }

        $query .= ") VALUES (:Firstname, :Lastname, :Username, :Email, :Sex, :DateOfBirth, :Password";

        // Additional placeholders for doctor registration
        if ($isDoctor) {
            $query .= ", :role, :Region, :City, :Street, :PostalCode, :status";
        }

        $query .= ")";

        $req = $db->prepare($query);
        $req->bindValue(":Firstname", $user['firstname']);
        $req->bindValue(":Lastname", $user['lastname']);
        $req->bindValue(":Username", $user['username']);
        $req->bindValue(":Email", $user['email']);
        $req->bindValue(":Sex", $user['sex']);
        $req->bindValue(":DateOfBirth", $user['DoB']);
        $req->bindValue(":Password", $user['password']);

        // Bind additional values for doctor registration
        if ($isDoctor) {
            $req->bindValue(":role", $user['role']);
            $req->bindValue(":Region", $user['region']);
            $req->bindValue(":City", $user['city']);
            $req->bindValue(":Street", $user['street']);
            $req->bindValue(":PostalCode", $user['postal_code']);
            $req->bindValue(":status","pending");
        }

        try {
            
            $req->execute();
            $lastId = $db->lastInsertId();
            return  $lastId; // Insertion successful
        } catch (PDOException $e) {
            return "An error occurred during registration. Please try again.";
        }
    }

    // Helper method to check if the email is unique
    private function isEmailUnique($email) {
        $query = "SELECT COUNT(*) FROM users WHERE Email = :Email";
        $result = $this->executeQuery($query, [':Email' => $email]);
        return ($result[0]['COUNT(*)'] == 0);
    }

    // Helper method to check if the username is unique
    private function isUsernameUnique($username) {
        $query = "SELECT COUNT(*) FROM users WHERE Username = :Username";
        $result = $this->executeQuery($query, [':Username' => $username]);
        return ($result[0]['COUNT(*)'] == 0);
    }

    // Helper method to execute a database query
    private function executeQuery($query, $params) {
        $db = config::getConnexion();

        $req = $db->prepare($query);
        $req->execute($params);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

function listPatients()
{
        $db=config::getConnexion();
        try {
            $query = "SELECT * FROM users WHERE Role = :role AND Status=:approved";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':role',"patient", PDO::PARAM_STR);
            $stmt->bindValue(':approved',"approved", PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch the results
            $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $liste;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function listDoctors()
{
        $db=config::getConnexion();
        try {
            $query = "SELECT * FROM users WHERE Role !=:patient AND Role!=:admin AND Status=:approved";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':patient',"patient", PDO::PARAM_STR);
            $stmt->bindValue(':admin',"admin", PDO::PARAM_STR);
            $stmt->bindValue(':approved',"approved", PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch the results
            $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $liste;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function listbanned()
{
        $db=config::getConnexion();
        try {
            $query = "SELECT * FROM users WHERE Status=:banned";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':banned',"banned", PDO::PARAM_STR);
            $stmt->execute();
    
            // Fetch the results
            $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $liste;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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
        echo "Error: " . $e->getMessage();
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

            if (password_verify($enteredPassword, $storedHashedPassword) || $enteredPassword== $storedHashedPassword ) {
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
public function authenticationGoogle($email)
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
                return $result;
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

public function updatetoken($email,$RTH,$RTE){
    $db = config::getConnexion();
    try {
        $query = "UPDATE users SET ResetTokenHash=:rth, ResetTokenExpires=:rte WHERE Email=:email";
        $req = $db->prepare($query);
        $req->bindValue(":rth", $RTH);
        $req->bindValue(":rte", $RTE);
        $req->bindValue(":email", $email);
        $req->execute();
        $rowCount = $req->rowCount();

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $rowCount;
}

public function retrievetoken($RTH){
    $db = config::getConnexion();
    try{
        $query="SELECT * FROM users WHERE ResetTokenHash=:RTH";
        $req = $db->prepare($query);
        $req->bindValue(":RTH", $RTH);
        $req->execute();
        $liste = $req->fetchAll(PDO::FETCH_ASSOC);
        return $liste;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

public function updatepassword($password_hash,$id){
    $db = config::getConnexion();
    try{
        $query = "UPDATE users SET 
        Password=:pw ,
        ResetTokenHash=NULL ,
        ResetTokenExpires=NULL 
        WHERE Id=:id";
        $req = $db->prepare($query);
        $req->bindValue(":pw", $password_hash);
        $req->bindValue(":id", $id);
        $req->execute();
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

public function pending()
{
        $db=config::getConnexion();
        try {
            $query="SELECT * FROM users WHERE Status='pending'";
            $liste=$db->query($query);
            return $liste;
    } catch (PDOException $e) {
        echo "bob";
    }
}
public function acceptpending($id){
    $db = config::getConnexion();
    try{
    $query="UPDATE users SET Status=:sts WHERE Id=:id";
    $req = $db->prepare($query);
    $req->bindValue(":sts","approved");
    $req->bindValue(":id",$id);
    $req->execute();
    $liste = $req->fetchAll(PDO::FETCH_ASSOC);
        return $liste;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
public function banuser($id){
    $db = config::getConnexion();
    try{
        $query="UPDATE users SET Status=:sts WHERE Id=:id";
        $req = $db->prepare($query);
        $req->bindValue(":sts","banned");
        $req->bindValue(":id",$id);
        $req->execute();
        $liste = $req->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
}
public function unbanuser($id){
    $db = config::getConnexion();
    try{
        $query="UPDATE users SET Status=:sts WHERE Id=:id";
        $req = $db->prepare($query);
        $req->bindValue(":sts","approved");
        $req->bindValue(":id",$id);
        $req->execute();
        $liste = $req->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
}
public function getRegistrationStatistics()
{
    $db = config::getConnexion();

    try {
        $query = "SELECT DATE_FORMAT(CreationDate, '%Y-%m-%d') as CreationDate, COUNT(*) as registrations_count, Role FROM users WHERE CreationDate >= CURDATE() - INTERVAL 30 DAY GROUP BY CreationDate, Role";
        $result = $db->query($query);

        // Fetch the results as an associative array
        $registrationsData = $result->fetchAll(PDO::FETCH_ASSOC);

        return $registrationsData;
    } catch (PDOException $e) {
        // Handle the exception (you might want to log or throw it)
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array or handle the error accordingly
    }
}
public function geteveryrecord(){
    $db = config::getConnexion();
    try {
        $query="SELECT * FROM users";
        $liste=$db->query($query);
        return $liste;
} catch (PDOException $e) {
    echo "bob";
}
}








}

?>

