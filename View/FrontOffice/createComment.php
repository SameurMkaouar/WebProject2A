<?php
        session_start();
        $_SESSION['id_user'] = '1';

        require("../../Controller/Comment.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = isset($_POST['comment_content']) ? $_POST['comment_content'] : '';
            $id_post = isset($_POST['id_post']) ? $_POST['id_post'] : '';

            $comment["id_post"] = $id_post;
            $comment["comment_content"] = $content;
            $comment["id_user"] = $_SESSION['id_user'];
            
            $Comment = new Comment();
            $Comment->createComment($comment);

            header('Location: blog-single-full.html?id='.$id_post.'');
        }
?>

