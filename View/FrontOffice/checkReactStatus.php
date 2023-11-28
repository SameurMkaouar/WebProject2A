<?php

session_start();
$_SESSION['id_user'] = '2';

require("../../Controller/Post.php");

$react = $_GET['react'];
$id_post = $_GET['id_post'];
$id_user = $_SESSION['id_user'];

$Post = new Post();
if ($react=="like") {
    $isReacted = $Post->checkLike($id_post, $id_user, $react);
    echo ($isReacted)?"True":"False";
} else if($react=="dislike"){ 
    $isReacted = $Post->checkLike($id_post, $id_user, $react);
    echo ($isReacted)?"True":"False";
}

?>