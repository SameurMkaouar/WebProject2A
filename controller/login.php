<?php
session_start();
include("../model/user.php");
require_once ("../model/util.php");

$errorMsg = "";
$banMessage="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user = new user();
    $result = $user->authentication($email, $password);
    
    if ($result) {
        if($result[0]['Status']==="banned")
        {
            $banMessage="your account has been banned";
            header("Location: ../view/frontoffice/login.php?ban=" . urlencode($banMessage));
            exit();
        }
        else{
        
        // Authentication successful
        // Do further actions, like setting session variables and redirecting
        $_SESSION['user_id'] = $result[0]['Id']; // Assuming 'Id' is the column in your users table
        $_SESSION['username'] = $result[0]['Username']; // Assuming 'Username' is the column in your users table
        $_SESSION['role'] = $result[0]['Role']; // Assuming 'Username' is the column in your users table 
        $_SESSION['picture']= $result[0]['Picture'];
        $_SESSION['mail']=$result[0]['Email'];
        if (isset($_POST['checkbox'])) {
            setcookie('emailid', $_POST["email"], time() + 60 * 60, '/');
            setcookie('password', $_POST["password"], time() + 60 * 60, '/');
        } else {
            setcookie('emailid', '', time() - 3600, '/'); // set value to empty and expire in the past
            setcookie('password', '', time() - 3600, '/'); // set value to empty and expire in the past
        }
        
        if (has_role('admin')){
            
    header("Location:../view/backoffice/admin_index.php");
        exit();}
        else{
            header("Location:../view/frontoffice/homepage.php");
            exit();}
        }
    }
    else {
        // Authentication failed
        // You might want to display an error message or redirect back to the login page
        $errorMsg = "Invalid email or password";
        header("Location: ../view/frontoffice/login.php?login_error=" . urlencode($errorMsg));

        
        // Pass the error message as a URL parameter
        
        exit();
    }

}
?>