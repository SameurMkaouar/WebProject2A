<?php
session_start();
$_SESSION['id_user'] = '1';

$idpost = $_GET['id_user'] ?? '';
if ($idpost === $_SESSION['id_user']) {
    echo '1';
} else {
    echo '0';
}
?>