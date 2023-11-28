<?php
        session_start();
        $_SESSION['id_user'] = 2;

        require("../../Controller/Post.php");
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id_post = $_GET['id_post'];
            $id_user = $_SESSION['id_user'];
            $type = $_GET['type'];
        }
            $Post = new Post();
            if($_GET['type'] == "like"){$Post->likePost($id_post, $id_user, $type);}
            else if ($_GET['type'] == "unlike"){$Post->unlikePost($id_post, $id_user, "like");}
            else if($_GET['type'] == "dislike"){$Post->dislikePost($id_post, $id_user, "dislike");}
            else if($_GET['type'] == "undislike"){$Post->unDislike($id_post, $id_user, "dislike");}
        
?>

