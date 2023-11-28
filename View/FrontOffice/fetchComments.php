<?php
    require('../../Controller/Comment.php');
    $id_post = isset($_GET['id']) ? $_GET['id'] : '';
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : '';

    $Comment = new Comment();
    if ($id_post != ""){
        $comments = $Comment->getPostComments($id_post);
    }
    else if ($id_user != ""){
        $comments = $Comment->getUserPostComments($id_user);
    }
    $jsonData = json_encode($comments, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
?>

