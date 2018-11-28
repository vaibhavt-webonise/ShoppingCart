<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/DatabaseConnection.php';
    include_once '../../objects/Product.php';

    $database = new DatabaseConnection();
    $db = $database->getConnection();

    $product = new Product($db);
    $data = json_decode(file_get_contents("php://input"));

    if( !empty($data->Product_Name) &&
        !empty($data->Description) &&
        !empty($data->Price) &&
        !empty($data->Discount)&&
        !empty($data->Category_Name)
      ){
          $product->product_name=$data->Product_Name;
          $product->product_description=$data->Description;
          $product->price=$data->Price;
          $product->discount=$data->Discount;
          $product->category=$data->Category_Name;

        if($product->create()){
            http_response_code(201);
            echo json_encode(array("message" => "Product was created."));
        }
        else{
          http_response_code(503);
          echo json_encode(array("message" => "Unable to create product."));
        }
      }
      else{
          http_response_code(400);
          echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
      }
?>