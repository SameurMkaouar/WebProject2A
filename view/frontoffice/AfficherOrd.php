<?php
include_once 'header.php';
require_once 'C:\xampp\htdocs\Web\controller\ordonance.php';

$selectedPatientId = 45; // Mettez ici l'ID du patient sélectionné

$ordonnances = new Ordonance();
$ordonnance_info = $ordonnances->getOrdonanceByPatientId($selectedPatientId);

if ($ordonnance_info) {
    echo '<h2>Informations sur l\'ordonnance</h2>';
    echo '<p><label>ID de l\'ordonnance:</label> ' . $ordonnance_info['id_ord'] . '</p>';
    echo '<p><label>Description:</label> ' . $ordonnance_info['description'] . '</p>';
    echo '<p><label>Nom du patient:</label> ' . $ordonnance_info['name'] . '</p>';
    echo '<p><label>Date du rendez-vous:</label> ' . date('Y-m-d H:i', strtotime($ordonnance_info['date'])) . '</p>';
    echo '<p><label>Docteur:</label> ' . $ordonnance_info['doc'] . '</p>';
} else {
    echo '<p>Aucune information d\'ordonnance trouvée pour ce patient.</p>';
}

include_once 'footer.php';
?>

