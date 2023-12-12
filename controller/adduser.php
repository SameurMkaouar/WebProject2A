<?php
session_start();
require_once "../model/user.php";
require_once "../model/util.php";
require_once "../model/notifications.php";


$warning='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging
    $notif= new notif;
    $userC = new user();
    $user["firstname"] = $_POST["firstname"];
    $user["lastname"] = $_POST["lastname"];
    $user["username"] = $_POST["username"];
    $user["email"] = $_POST["email"];
    $user["sex"] = $_POST["sex"];
    $user["DoB"] = $_POST["DoB"];
    $user["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if($_POST["region"]!=="") {
       // Debugging

        $user["role"] =$_POST["speciality"];
        $user["region"] = $_POST["region"];
        $user["city"] = $_POST["city"];
        $user["street"] = $_POST["street"];
        $user["postal_code"] = $_POST["postal_code"];
        $registrationResult = $userC->adduser($user,true);
        $warning='Please complete the missing information in your profile to expedite the approval process.';
       

    }else{$registrationResult = $userC->adduser($user);}
    

    // Call adduser method and check the return value
    

    if ($registrationResult !== "An error occurred during registration. Please try again.") {
        // Registration successful
        
        $_SESSION['user_id'] = $registrationResult;
        $_SESSION['username'] = $user["username"];
        $notifcontent="New doctor request from ". $_SESSION['username'];
        
        $notifResult=$notif->addRegNotification($notifcontent,$_SESSION['user_id']);
        
        $result = $userC->retrieveInformation($_SESSION['user_id']);
        if (!empty($result)) {
            
            $userRecords = $result[0];
            $_SESSION['role'] = $userRecords['Role'];
            $_SESSION['picture'] = $userRecords['Picture'];
            $_SESSION['mail']=$userRecords['Email'];

            
            
                
                header("Location:../view/frontoffice/homepage.php?warning=" . urlencode($warning));
                exit();
            
        }
    } else {
        // Registration failed, display an error message
        header("Location: ../view/frontoffice/login.php?signup_error=" . urlencode($registrationResult));
        exit();
    }
}
?>
