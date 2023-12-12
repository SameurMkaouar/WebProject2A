<?php
    require('../model/Post.php');
    require_once "../model/user.php";

    $Post = new Post();


    //FILTER POSTS BY TAG
    $posts = $Post->getPublishedPosts();
   
    $posts = addUser($posts);


    
    //TRANSFORMER LES DATES EN VERSION PLUS LISIBLE et kes images en url
    foreach ($posts as &$post) {
        $dateTime = new DateTime($post["post_time"]);
        $formattedString = $dateTime->format('F j, Y : H:i:s');
        
        $post["post_time"] = $formattedString;
        $post["post_img"] = base64_encode($post["post_img"]);
    }

    $jsonData = json_encode($posts, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
    
   

    function addUser($posts){
        $user = new user;
        foreach ($posts as &$post) {   
            $result = $user->retrieveInformation($post['id_user']);
            if ($result) {
                $userInformation = $result[0];
                $post['Firstname'] = $userInformation['Firstname'];
                $post['Lastname'] = $userInformation['Lastname'];
                $post['Picture'] = base64_encode($userInformation['Picture']);
                $post['Email'] = $userInformation['Email'];
            }
        }
        return $posts;
    }
    ?>

