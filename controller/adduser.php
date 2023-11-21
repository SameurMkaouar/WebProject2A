<?php
require_once "../model/user.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user["firstname"] = $_POST["firstname"];
    $user["lastname"] = $_POST["lastname"];
    $user["username"] = $_POST["username"];
    $user["email"] = $_POST["email"];
    $user["sex"] = $_POST["sex"];
    $user["DoB"] = $_POST["DoB"];
    $user["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $userC = new user();
    $userC->adduser($user);
    session_start();
    $_SESSION['user_id'] = $userC->get_last_inserted_id();
    $_SESSION['username'] = $user["username"];
    header("Location:../view/frontoffice/homepage.php");
    
}
