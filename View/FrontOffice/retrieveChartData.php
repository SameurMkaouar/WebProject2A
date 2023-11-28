<?php
    require("../../Controller/Post.php");    


    $Post = new Post();
    $data = $Post->getChartData();
    $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $jsonData;
        
?>
