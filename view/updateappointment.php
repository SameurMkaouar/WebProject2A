<?php
include("../Controller/appoi.php");

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    $appointment = new appointment();
    $appointmentInfo = $appointment->getAppInfo($appointmentId);

    if ($appointmentInfo) {
        $date = $appointmentInfo['Date'];
        $email = $appointmentInfo['email'];
        $online = $appointmentInfo['online'];
        $tel = $appointmentInfo['tel'];
    } else {
        echo "Le rendez-vous n'existe pas.";
    }
} else {
    echo "L'identifiant du rendez-vous n'a pas été spécifié.";
}
?>

<form method="post" action="updateAppointment.php?id=<?php echo $appointmentId; ?>">
    Date : <input type="text" name="Date" value="<?php echo $date; ?>"><br>
    Email : <input type="text" name="email" value="<?php echo $email; ?>"><br>
    Online : <input type="text" name="online" value="<?php echo $online; ?>"><br>
    Téléphone : <input type="text" name="tel" value="<?php echo $tel; ?>"><br>
    <input type="submit" value="Enregistrer les modifications">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['id'])) {
        $appointmentId = $_GET['id'];
        $nouveauDate = $_POST['Date'];
        $nouveauEmail = $_POST['email'];
        $nouveauOnline = $_POST['online'];
        $nouveauTel = $_POST['tel'];

        $appointment = new appointment();
        $appointment->updateAppointment($appointmentId, $nouveauDate, $nouveauEmail, $nouveauOnline, $nouveauTel);
        header("location: ListApp.php");
        exit;
    } else {
        echo "L'identifiant du rendez-vous n'a pas été spécifié.";
    }
}
?>
