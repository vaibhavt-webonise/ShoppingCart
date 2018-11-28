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

    if( !empty($data->Name) &&
        !empty($data->Description) &&
        !empty($data->Tax)
      ){
          $categories->name=$data->Name;
          $categories->description=$data->Description;
          $categories->tax=$data->Tax;

        if($categories->create()){
            http_response_code(201);
            echo json_encode(array("message" => "Categories Creeated Successfully."));
        }
        else{
          http_response_code(503);
          echo json_encode(array("message" => "Unable to Add Categories."));
        }
      }
      else{
          http_response_code(400);
          echo json_encode(array("message" => "Unable to Add Categories. Data is incomplete."));
      }
?>