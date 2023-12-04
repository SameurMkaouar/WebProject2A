<?php
require '../../config.php';

$pdo = config::getConnexion();
$display_query = "SELECT idevent, nomevent, dateevent FROM event";
$statement = $pdo->prepare($display_query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$count = count($results);

if ($count > 0) {
    $data_arr = array();
    $i = 1;

    foreach ($results as $data_row) {
        $data_arr[$i]['event_id'] = "ID : ".$data_row['idevent']." | Nom : ".$data_row['nomevent'];
        $data_arr[$i]['title'] = $data_row['nomevent'];
        $data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['dateevent']));
        $data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['dateevent']));
        $data_arr[$i]['color'] = 'grey'; // 'green'; pass colour name
        $i++;
    }

    $data = array(
        'status' => true,
        'msg' => 'successfully!',
        'data' => $data_arr
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error!'
    );
}

echo json_encode($data);
?>
