<?php
    require("../model/Post.php");    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    $Post = new Post();
    $data = $Post->getChartData();
    $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
        
?>
