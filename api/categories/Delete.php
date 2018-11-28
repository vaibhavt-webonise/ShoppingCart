<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/DatabaseConnection.php';
    include_once '../../objects/Categories.php';

    $database = new DatabaseConnection();
    $db = $database->getConnection();

    $categories = new Categories($db);
    $data = json_decode(file_get_contents("php://input"));


    $categories->name=$data->Name;


    if($categories->delete()){
        http_response_code(200);
        echo json_encode(array("message" => "Categories was deleted."));
    }
    else{
      http_response_code(503);
      echo json_encode(array("message" => "Unable to delete categories."));
    }
?>