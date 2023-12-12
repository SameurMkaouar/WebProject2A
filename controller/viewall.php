<?php
require_once "../model/notifications.php";


$notif=new notif;
$notif->viewAll();
header("location:../view/backoffice/admin_index.php");

?>