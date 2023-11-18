<?php
    require('../../Controller/Post.php');

    $Post = new Post();
    $posts = $Post->getAllPost();
    //TRANSFORMER LES DATES EN VERSION PLUS LISIBLE et kes images en url
    foreach ($posts as &$post) {
        $dateTime = new DateTime($post["post_time"]);
        $formattedString = $dateTime->format('F j, Y : H:i:s');
        $post["post_time"] = $formattedString;
        $post["post_img"] = base64_encode($post["post_img"]);
    }

    $jsonData = json_encode($posts, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
?>

