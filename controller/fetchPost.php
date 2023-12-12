<?php
    require('../model/Post.php');
    require('../model/user.php');

   
    $id = $_GET["id"];
    $Post = new Post();
    $post = $Post->getPost($id);
    $user = new user;
    $result = $user->retrieveInformation($post['id_user']);
    
    //TRANSFORMER DATE EN VERSION PLUS LISIBLE
    $dateTime = new DateTime($post["post_time"]);
    $formatteddatetime = $dateTime->format('F j, Y : H:i:s');
    $time = $dateTime->format('H:i');
    $date = $dateTime->format('Y-m-d');

    $singlePost["Picture"] = base64_encode($result[0]['Picture']);
    $singlePost["Firstname"] = $result[0]['Firstname'];
    $singlePost["Lastname"] = $result[0]['Lastname'];
    $singlePost["Email"] = $result[0]['Email'];
    $singlePost["publish_date"] = $date;
    $singlePost["publish_time"] = $time;
    $singlePost["post_time"] = $formatteddatetime;
    $singlePost["post_content"] = $post["post_content"];
    $singlePost["post_title"] = $post["post_title"];
    $singlePost["post_img"] = base64_encode($post["post_img"]);
    $singlePost["id_post"] = $id;
    $singlePost["id_user"] = $post["id_user"];
    $singlePost["post_likes"] = $post["post_likes"];
    $singlePost["post_dislikes"] = $post["post_dislikes"];
    $singlePost["post_comments"] = $post["post_comments"];


    $jsonData = json_encode($singlePost, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
?>