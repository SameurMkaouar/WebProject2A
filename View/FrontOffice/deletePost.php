<?php
        require("../../Controller/Post.php");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $Post = new Post();
            $Post->deletePost($id);
            
        }
?>