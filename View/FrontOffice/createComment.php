<?php
        require("../../Controller/Comment.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = isset($_POST['comment_content']) ? $_POST['comment_content'] : '';
            $id_post = isset($_POST['id_post']) ? $_POST['id_post'] : '';

            echo''. $id_post .''. $content .'';
            $comment["id_post"] = $id_post;
            $comment["comment_content"] = $content;

            $Comment = new Comment();
            $Comment->createComment($comment);

            header('Location: blog-single-full.html?id='.$id_post.'');
        }
?>

