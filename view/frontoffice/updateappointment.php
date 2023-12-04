<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le rendez-vous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    
<?php
ob_start();
include("../../Controller/appoi.php");
include_once("header.php");


// Vérifie si le formulaire est soumis et si l'identifiant du rendez-vous est spécifié
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $appointmentId = $_POST['id'];
    $newDate = $_POST['date'];
    $newEmail = $_POST['email'];
    $newOnline = $_POST['online'];
    $newTel = $_POST['tel'];

    $appointment = new appointment();
    $appointment->updateAppointment($appointmentId, $newDate, $newEmail, $newOnline, $newTel);

    header("Location: appointments.php"); // Redirection après la mise à jour
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
        <input type="hidden" name="id" value="' . $appointmentId . '">
        Date : <input type="text" name="date" value="' . $date . '"><br>
        Email : <input type="text" name="email" value="' . $email . '"><br>
        Online : <input type="text" name="online" value="' . $online . '"><br>
        Téléphone : <input type="text" name="tel" value="' . $tel . '"><br>
        <input type="submit" value="Enregistrer les modifications">
    </form>';
}


?>
</body>
</html>
<?php
include_once("footer.php");
?>
