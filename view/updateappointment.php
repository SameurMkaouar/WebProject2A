<?php
ob_start();
include("../Controller/appoi.php");
include_once("header.php");


// Vérifie si le formulaire est soumis et si l'identifiant du rendez-vous est spécifié
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['appointment_id'])) {
    $appointmentId = $_POST['appointment_id'];
    $newDate = $_POST['date'];
    $newEmail = $_POST['email'];
    $newOnline = $_POST['online'];
    $newTel = $_POST['tel'];

    $appointment = new appointment();
    $appointment->updateAppointment($appointmentId, $newDate, $newEmail, $newOnline, $newTel);

    header("Location: updateappointment.php"); // Redirection après la mise à jour
    exit;
}

// Affiche les formulaires de modification pour chaque rendez-vous
$appointment = new appointment();
$appointments = $appointment->getAllAppointments(); // Supposons que cette méthode récupère tous les rendez-vous

foreach ($appointments as $appointmentInfo) {
    $appointmentId = $appointmentInfo['id'];
    $date = $appointmentInfo['date'];
    $email = $appointmentInfo['email'];
    $online = $appointmentInfo['online'];
    $tel = $appointmentInfo['tel'];

    // Affiche le formulaire de modification avec les informations actuelles du rendez-vous
    echo '
    <form method="post" action="">
        <input type="hidden" name="appointment_id" value="' . $appointmentId . '">
        Date : <input type="text" name="Date" value="' . $date . '"><br>
        Email : <input type="text" name="email" value="' . $email . '"><br>
        Online : <input type="text" name="online" value="' . $online . '"><br>
        Téléphone : <input type="text" name="tel" value="' . $tel . '"><br>
        <input type="submit" value="Enregistrer les modifications">
    </form>';
}
include_once("footer.php");

?>
