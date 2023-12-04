<?php
require_once("../Controller/appoi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["appointment_id"])) {
    $id = $_POST["appointment_id"];
    
    $a = new appointment();
    // Ajoutez une vérification si l'ID existe avant de tenter de supprimer
    $a->deleteappointment($id);

    // Redirigez après la suppression
    header("Location: FrontOffice/appointments.php");
    exit();
} else {
    // Gérez le cas où l'ID n'est pas défini
    echo "ID not specified or invalid.";
}
?>
