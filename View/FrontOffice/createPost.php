<?php
        require("../../Controller/Post.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ptitle = isset($_POST['post_title']) ? $_POST['post_title'] : '';
            $pcontent = isset($_POST['post_content']) ? $_POST['post_content'] : '';
            $pcatg = isset($_POST['post_categorie']) ? $_POST['post_categorie'] : '';
            $imgFile = isset($_FILES['image']) ? $_FILES['image'] : '';

            $post["post_img"] = file_get_contents($imgFile["tmp_name"]);
            $post["post_title"] = $ptitle;
            $post["post_content"] = $pcontent;
            $post["post_categorie"] = $pcatg;

            $Post = new Post();
            $Post->createPost($post);

            header('Location: blog-full.html');
        }
?>

