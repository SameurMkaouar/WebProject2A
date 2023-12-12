<?php
    include("../model/user.php");

    $user = new user();
    $user->unbanuser($_GET['id']);
    header("location:../view/backoffice/tabs.php");
?>