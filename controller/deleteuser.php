<?php
    include("../model/user.php");

    $user = new user();
    $user->deleteuser($_GET['id']);
    header("location:../view/backoffice/tabs.php");
?>