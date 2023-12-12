<?php
    require_once "../model/util.php";
    require_once "../model/user.php";

    if(isset($_GET['id_user'])) {
        $user = new user;
        $result = $user->retrieveInformation($_GET['id_user']);
        $userInfo = json_encode($result[0], JSON_UNESCAPED_UNICODE);
        echo json_encode($result[0]['Picture']);
    } else {
        echo json_encode(["error" => "User ID not provided"]);
    }
?>
