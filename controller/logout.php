<?php
session_start();
if (isset($_SESSION["username"]) && $_SESSION["user_id"]){
    session_unset();
    session_destroy();
    header("Location:../view/frontoffice/homepage.php");
}

?>