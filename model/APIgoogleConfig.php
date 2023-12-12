<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$clientID = "1087083348844-d7orfcodih93m7a6g69jf4778ts7ha05.apps.googleusercontent.com";
$secret = "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";

// Google API Client
$gclient = new Google_Client();

// Set the ClientID
$gclient->setClientId($clientID);
// Set the ClientSecret
$gclient->setClientSecret($secret);
// Set the Redirect URL after successful Login
$gclient->setRedirectUri('http://localhost/Projet/WebProject2Afinale/view/frontoffice/login.php');

// Adding the Scopr
$gclient->addScope('email');
$gclient->addScope('profile');
