<?php
        session_start();

        require("../model/Comment.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = isset($_POST['comment_content']) ? $_POST['comment_content'] : '';
            $id_post = isset($_POST['id_post']) ? $_POST['id_post'] : '';

            $comment["id_post"] = $id_post;
            $comment["comment_content"] = $content;
            $comment["id_user"] = $_SESSION['user_id'];
            
            $Comment = new Comment();
            $Comment->createComment($comment);

            header('Location: ../view/frontoffice/blog-single-full.php?id='.$id_post.'');
        }
?>

