<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.inc.php';
include_once '../classes/task.php';

$database = new Database();
$db = $database->getConnection();
$items = new Task($db);
$statement = $items->getTasks();
$itemCount = $statement->rowCount();

echo json_encode($itemCount);

if($itemCount>0){
    $tasksArr = array();
    $tasksArr['body'] = array();
    $tasksArr['itemCount'] = $itemCount;

    while($row = $statement->fetch(\PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "title" => $title,
            "description" => $description,
        );
        array_push($tasksArr['body'], $e);

    }
    echo json_encode($tasksAr);
}else{
    http_response_code(404);
    echo json_encode(array('message' => 'No record found'));
}

?>