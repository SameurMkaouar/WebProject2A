<?php
    include("../model/user.php");
    include("../model/notifications.php");

    $notif= new notif;
    
    $user = new user();
    $user->acceptpending($_GET['id']);
    $notifcontent="your account has been approved";
    $result=$notif->addacceptNotification($notifcontent,$_GET['id']);
    echo $result;

    header("location:../view/backoffice/tabs.php");
?>