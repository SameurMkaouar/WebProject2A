<?php include_once 'header.php'; ?>
<?php
include_once 'C:\xampp\htdocs\Web\controller\ordonance.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_id_ord'], $_POST['new_description'], $_POST['new_id_appointment'])) {
        $new_id_ord = $_POST['new_id_ord'];
        $new_description = $_POST['new_description'];
        $new_id_appointment = $_POST['new_id_appointment'];

        $ordonnances = new Ordonance();
        $ordonnances->addOrdonance($new_id_ord, $new_description, $new_id_appointment);
        echo 'Nouvelle ordonnance ajoutée avec succès.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une ordonnance</title>
    <link rel="stylesheet" href="../../Assets/FrontOffice/css/ordonance.css"> <!-- Inclusion du fichier CSS -->
</head>
<body>
    <h1 style="text-align: center;">Ajouter une nouvelle ordonnance</h1>
    <form action="appoinMedecin.php" method="POST">
        Nouvel ID de l'ordonnance : <input type="text" name="new_id_ord" placeholder="Nouvel ID de l'ordonnance"><br>
        Description de la nouvelle ordonnance : <input type="text" name="new_description" placeholder="Description de la nouvelle ordonnance"><br>
        Nouvel ID de l'appointment : <input type="text" name="new_id_appointment" placeholder="Nouvel ID de l'appointment"><br>
        <input type="submit" value="Ajouter une nouvelle ordonnance">
    </form>
</body>
</html>

<?php include_once 'footer.php'; ?>

