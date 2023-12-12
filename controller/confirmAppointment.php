<?php 
require_once "../model/appoi.php";
$id_app=$_GET['id_app'];
$app=new appointment;
$app->confirmApp($id_app);
header('Location: ../view/frontoffice/dashbordDoc.php');
exit();

?>