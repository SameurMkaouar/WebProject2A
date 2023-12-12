<?php
        session_start();

        require("../model/Post.php");
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id_post = $_GET['id_post'];
            $id_user = $_SESSION['user_id'];
            $type = $_GET['type'];
        }
            $Post = new Post();
            if($_GET['type'] == "like"){$Post->likePost($id_post, $id_user, $type);}
            else if ($_GET['type'] == "unlike"){$Post->unlikePost($id_post, $id_user, "like");}
            else if($_GET['type'] == "dislike"){$Post->dislikePost($id_post, $id_user, "dislike");}
            else if($_GET['type'] == "undislike"){$Post->unDislike($id_post, $id_user, "dislike");}
        
?>

