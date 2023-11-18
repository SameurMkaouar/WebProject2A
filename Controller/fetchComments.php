<?php
    require('Comment.php');
    $id_post = $_GET["id"];
    $Comment = new Comment();
    $comments = $Comment->getPostComments($id_post);

    $jsonData = json_encode($comments, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
?>

