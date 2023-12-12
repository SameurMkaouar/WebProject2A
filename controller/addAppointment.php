<?php
session_start();
require_once "../model/appoi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app1 = new appointment();


    $app['id_p'] = $_SESSION["user_id"];
    $app['id_d'] = $_POST['doc_id'];
    $app['name'] = $_SESSION["username"];
    $app['email'] = $_SESSION["mail"];
    $app['type'] = $_POST['type'];
    $app['date'] = $_POST['date'];
    $app1->addappointment($app);
    header('Location: ../view/frontoffice/doctors.php');
}
