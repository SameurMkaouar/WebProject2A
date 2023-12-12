<?php
        require("../model/Comment.php");
        $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['id'])) {
            $id = $_GET['id'];
            }
            else if(isset($_GET['id_comment'])) {
                $id = $_GET['id_comment'];
            }

            $Comment = new Comment();
            $Comment->deleteComment($id);  
            
            header("Location: " . $_SESSION['previous_page']);
            
        }
?>