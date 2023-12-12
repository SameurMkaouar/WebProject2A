<?php
session_start();

$idpost = $_GET['id_user'] ?? '';


if ($idpost == $_SESSION['user_id']) {
    echo '1';
} else {
    echo '0';
}
?>