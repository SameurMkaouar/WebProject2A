<?php
session_start();
        require("../model/Post.php");
        require("../model/Subscriber.php");
        require_once "../model/notifications.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ptitle = isset($_POST['post_title']) ? $_POST['post_title'] : '';
            $pcontent = isset($_POST['post_content']) ? $_POST['post_content'] : '';
            $pcatg = isset($_POST['post_categorie']) ? $_POST['post_categorie'] : '';
            $imgFile = isset($_FILES['image']) ? $_FILES['image'] : '';

            $post["post_img"] = file_get_contents($imgFile["tmp_name"]);
            $post["post_title"] = $ptitle;
            $post["post_content"] = $pcontent;
            $post["post_categorie"] = implode('-', $pcatg);
            $post["user_id"] = $_SESSION['user_id'];



            echo $post["post_categorie"];
            
            $Post = new Post();
            $Sub = new Sub();
            $notif=new notif();
            $Post->createPost($post);
            $notifcontent="new post request from ".$_SESSION['usernaame'];
            $notifresult=$notif->addPostNotification($notifcontent,$_SESSION['user_id']);
            echo $Sub->sendMailToSubscribers($post);


            header('Location: ../view/frontoffice/blog-full.php');
            exit();
        }
?>
