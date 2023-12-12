<?php

session_start();

require("../model/Post.php");

$react = $_GET['react'];
$id_post = $_GET['id_post'];
$id_user = $_SESSION['user_id'];

$Post = new Post();
if ($react=="like") {
    $isReacted = $Post->checkLike($id_post, $id_user, $react);
    echo ($isReacted)?"True":"False";
} else if($react=="dislike"){ 
    $isReacted = $Post->checkLike($id_post, $id_user, $react);
    echo ($isReacted)?"True":"False";
}

?>