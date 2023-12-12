<?php
require_once "../model/user.php";
$user=new user;
$user->banuser($_GET['id']);
header("location:../view/backoffice/tabs.php");
exit();
?>