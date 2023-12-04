<?php
ob_start();

include_once 'header.php';
include("../../Controller/appoi.php");

$a = new appointment();

$iddoc = ""; // Initialisez $iddoc en dehors de la logique POST

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["medID"])) {
        $iddoc = $_POST["medID"];
    }

    if (isset($_POST['confirm'])) {
        $appointment_id = $_POST['appointment_id'];
        $a->confirmAppointment($appointment_id);
        header('Location: ../../Assets/FrontOffice/email/send-email.php?success');
        exit();
    }

    if (isset($_POST['delete'])) {
        $appointment_id = $_POST['appointment_id'];
        $a->deleteappointment($appointment_id);
        
        header('Location: ../../Assets/FrontOffice/email/send-email.php?echec');
    }
}
?>

<form method="post" action="medecins.php" style="text-align:center; margin-top:1rem;">
    <label for="medID">Doctor ID:</label>
    <input type="text" name="medID" id="medID">
    <input class="theme_button color1" type="submit" value="Submit">

</form>

<!-- Affichage du tableau des rendez-vous -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["medID"])) {
    $a->listAppForDoctorPreConfirmation($iddoc); // Affichage du tableau après la recherche
}
?>

<?php
include_once 'footer.php';
?>

