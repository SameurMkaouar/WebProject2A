<?php
session_start();
require_once __DIR__ . '/../config.php';
require "../model/appoi.php";
$db = config::getConnexion();
$doc_id=$_SESSION['user_id'];
$stmt = $db->prepare("SELECT id, date, type, name FROM appoitment WHERE id_doc=$doc_id AND confirmation=1 ");
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($appointments); 

?>