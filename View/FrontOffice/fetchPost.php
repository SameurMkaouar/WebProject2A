<?php
    require('../../Controller/Post.php');

    $id = $_GET["id"];
    $Post = new Post();
    $post = $Post->getPost($id);
    
    //TRANSFORMER DATE EN VERSION PLUS LISIBLE
    $dateTime = new DateTime($post["post_time"]);
    $formatteddatetime = $dateTime->format('F j, Y : H:i:s');
    $time = $dateTime->format('H:i');
    $date = $dateTime->format('Y-m-d');

    $singlePost["publish_date"] = $date;
    $singlePost["publish_time"] = $time;
    $singlePost["post_time"] = $formatteddatetime;
    $singlePost["post_content"] = $post["post_content"];
    $singlePost["post_title"] = $post["post_title"];
    $singlePost["post_img"] = base64_encode($post["post_img"]);
    $singlePost["id_post"] = $id;


    $jsonData = json_encode($singlePost, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
?>