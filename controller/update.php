<?php
session_start();
include("../model/user.php");

$user = new user();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $sex = $_POST["sex"];
    $picture = $_POST["picture"];

    $db = config::getConnexion();
    
    try {
        // Use prepared statement to update user information
        $query = "UPDATE users
                  SET Firstname = ?, Lastname = ?, Email = ?, Username = ?, Sex = ?, Picture = ?
                  WHERE Id = ?";
        
        $stmt = $db->prepare($query);
        $stmt->execute([$firstname, $lastname, $email, $username, $sex, $picture, $_SESSION['user_id']]);
        
        // Redirect to the desired location after the update
        header("location: ../view/frontoffice/test.php");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
$_SESSION['username']=$username;
?>
