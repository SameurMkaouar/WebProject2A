<?php
require('../../controller/reservation.php');
$rsvC = new reservationC();
$rsv = $rsvC->recupererReservation($_GET['id']);
$nbr = $rsv['nbplace'] + $_GET['nbEvent'];
$rsvC->updateNbrPlace($rsv['idevent'],$nbr);
$rsvC->supprimerReservation($_GET['id']);
header('Location: reservations.php');
?>