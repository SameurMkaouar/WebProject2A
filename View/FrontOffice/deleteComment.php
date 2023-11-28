<?php
        require("../../Controller/Comment.php");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $Comment = new Comment();
            $Comment->deleteComment($id);     
        }
?>