<?php
session_start();
require('../model/Subscriber.php');

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    echo $action;
    $userID = $_SESSION['user_id'];
    echo $userID;

    $mail = $_SESSION['mail'];
    echo  $mail;

    $sub = new Sub();

    try {
        switch ($action) {
            case 'sub':
                $result = $sub->addSub($userID, $mail);
                break;
            case 'unsub':
                $result = $sub->removeSub($userID);
                break;
            default:
                throw new Exception("Invalid action.");
        }
        echo $result;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
