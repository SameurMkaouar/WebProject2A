<?php
session_start();
require_once __DIR__ . '/../config.php';
require "../model/appoi.php";
$db = config::getConnexion();
$doc_id=$_SESSION['user_id'];
$stmt = $db->prepare("
    SELECT id, date, type, name, 
    CONCAT('Dr. ', (SELECT Lastname FROM users WHERE id_doc = Id LIMIT 1)) AS doc_name 
    FROM appoitment 
    WHERE id_patient = :doc_id"
);
    $stmt->bindParam(':doc_id', $doc_id);

    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    echo json_encode($appointments); 

?>