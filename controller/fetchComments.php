<?php
    require('../model/Comment.php');
    require('../model/user.php');
    $id_post = isset($_GET['id']) ? $_GET['id'] : '';
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : '';

    $Comment = new Comment();
    if ($id_post != ""){
        $comments = $Comment->getPostComments($id_post);
    }
    else if ($id_user != ""){
        $comments = $Comment->getUserPostComments($id_user);

    }
    $comments=addcommentUser($comments);
    $jsonData = json_encode($comments, JSON_UNESCAPED_UNICODE);
    echo $jsonData;

    function addcommentUser($posts){
        $user = new user;
        foreach ($posts as &$post) {   
            $result = $user->retrieveInformation($post['id_user']);
            if ($result) {
                $userInformation = $result[0];
                $post['Firstname'] = $userInformation['Firstname'];
                $post['Lastname'] = $userInformation['Lastname'];
                $post['Picture'] = base64_encode($userInformation['Picture']);
            }
        }
        return $posts;
    }
?>

