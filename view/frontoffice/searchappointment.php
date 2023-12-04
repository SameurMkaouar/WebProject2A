<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choisir une ordonnance</title>
</head>
<body>
    <h1>Choisir une ordonnance</h1>
    <form action="AfficherOrd.php" method="GET">
        <label for="id_ord">Saisissez l'ID de l'ordonnance :</label>
        <input type="text" name="id_ord" id="id_ord" placeholder="Entrez l'ID">
        <input type="submit" value="Afficher les détails">
    </form>

    <?php
    require_once 'C:\xampp\htdocs\Web\controller\ordonance.php';

include_once 'footer.php';
?>


