<?php
session_start();
        require("../model/Post.php");
        require_once "../model/util.php";

       
            $id = $_GET['id'];
           echo $id;
            $Post = new Post();
            $Post->deletePost($id);
            if(has_role("admin"))
            header("location:../view/backoffice/test.php");
            else
            header("location:../view/frontoffice/blog-full.php");
            
            
    
?>