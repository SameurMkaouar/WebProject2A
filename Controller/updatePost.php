<?php
        require("Post.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imgFile = isset($_FILES['image']) ? $_FILES['image'] : '';
            var_dump($imgFile);

            $newPost["post_content"] = $_POST["post_content"];
            $newPost["post_title"] = $_POST["post_title"];
            $newPost["id_post"] = $_POST["id_post"];


            $Post = new Post();
            $Post->updatePost($newPost);            
            if ($imgFile["name"] != '') {
                $Image = file_get_contents($imgFile['tmp_name']);
                $Post->updatePostImage($Image, $_POST["id_post"]);        
                }

            header('Location: ../View/FrontOffice/blog-single-full.html?id='.$newPost["id_post"].'');
        }
?>