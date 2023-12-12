<?php
    require("../model/Post.php");

    $idpost = $_GET['id_post'];
    $post = new Post();
    $post->approvePost($idpost);

    header('Location: ../view/backoffice/test.php');


?>