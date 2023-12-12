<?php
    require('../model/Post.php');
    require_once "../model/user.php";

    $Post = new Post();

    $sortType = isset($_GET['sort']) ? $_GET['sort'] : '';

    if(isset($_GET['tags'])){
        $tags = $_GET['tags'];
        $tagsArray = explode("-", $tags);
        if($tags == "")
        $tagsArray = [];
    }
    else{
        $tagsArray = [];
    }
    if ($sortType == ""){
        $posts = $Post->getAllPost();
    }
    else if ($sortType == "popular"){
        $posts = $Post->getPopularPosts();
    }
    else if ($sortType == "comments"){
        $posts = $Post->getPostsByComments();
    }
    else if ($sortType == "recent"){
        $posts = $Post->getRecentPosts();
    }
    //FILTER POSTS BY TAG
    
    $posts = filterbyTags($posts, $tagsArray);
    $posts = addUser($posts);


    if(!isset($_GET['admin'])){
        $posts = array_filter($posts, function($post) {
            return $post["post_status"] === "Published";
        });
    }
    
    //TRANSFORMER LES DATES EN VERSION PLUS LISIBLE et kes images en url
    foreach ($posts as &$post) {
        $dateTime = new DateTime($post["post_time"]);
        $formattedString = $dateTime->format('F j, Y : H:i:s');
        
        $post["post_time"] = $formattedString;
        $post["post_img"] = base64_encode($post["post_img"]);
    }

    $jsonData = json_encode($posts, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
    
    function filterByTags($posts, $tags){
        $filteredPosts = []; 
        if (!empty($tags)) {
            foreach ($posts as $post) {
                $postTags = explode('-', $post['post_categorie']);
                if (count(array_intersect($tags, $postTags)) === count($tags)) {
                    $filteredPosts[] = $post; 
                }
            }
        } else {
            $filteredPosts = $posts; 
        }
        return $filteredPosts;
    }

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

