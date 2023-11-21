<?php
session_start();
include("../model/user.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $user = new user();
    $result = $user->authentication($email, $password);
    
    if ($result) {
        // Authentication successful
        // Do further actions, like setting session variables and redirecting
        $_SESSION['user_id'] = $result[0]['Id']; // Assuming 'Id' is the column in your users table
        $_SESSION['username'] = $result[0]['Username']; // Assuming 'Username' is the column in your users table
        $_SESSION['role'] = $result[0]['Role']; // Assuming 'Username' is the column in your users table
        if ($_SESSION['role']=='patient')
        header("Location:../view/frontoffice/homepage.php");
    else if ($_SESSION['role']=='admin')
    header("Location:../view/backoffice/users_list.php");
        exit();
    } else {
        // Authentication failed
        // You might want to display an error message or redirect back to the login page
        echo "Invalid email or password";
    }
}
?>
