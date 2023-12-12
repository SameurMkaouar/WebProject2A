<?php
        require("../model/Post.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imgFile = isset($_FILES['image']) ? $_FILES['image'] : '';
            $pcatg = $_POST["post_categorie"];

            $newPost["post_content"] = $_POST["post_content"];
            $newPost["post_title"] = $_POST["post_title"];
            $newPost["id_post"] = $_POST["id_post"];
            $newPost["post_categorie"] = implode('-', $pcatg);


            $Post = new Post();
            $Post->updatePost($newPost);            
            if ($imgFile["name"] != '') {
                $Image = file_get_contents($imgFile['tmp_name']);
                $Post->updatePostImage($Image, $_POST["id_post"]);        
                }

            header('Location: ../view/frontoffice/blog-single-full.php?id='.$newPost["id_post"].'');
        }
?>