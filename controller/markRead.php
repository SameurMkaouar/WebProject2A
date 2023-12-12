<?php
require_once "../model/notifications.php";
$notificationId = $_POST['notificationId'];

$notif=new notif;
$result=$notif->markNotificationsAsRead($notificationId);

?>