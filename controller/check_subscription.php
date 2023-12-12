<?php
    require('../model/Subscriber.php');
    session_start();

    
    $id= $_SESSION['user_id'];
    
    $sub = new Sub();
    echo $sub->checkSub($id);


?>
