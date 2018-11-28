<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/DatabaseConnection.php';
    include_once '../../objects/Cart.php';

    $database = new DatabaseConnection();
    $db = $database->getConnection();

    $cart = new Cart($db);
    $data = json_decode(file_get_contents("php://input"));

    if( !empty($data->Customer_Name) &&
        !empty($data->Product_Name)
      ){
          $cart->customer_name=$data->Customer_Name;
          $cart->product_name=$data->Product_Name;
          if($cart->create()){
                   http_response_code(201);
                   echo json_encode(array("message" => "Product was added in the Cart ."));
          }
          else{
                    http_response_code(503);
                    echo json_encode(array("message" => "Unable to add  product in the cart."));
          }
      }
          else{
                http_response_code(400);
                echo json_encode(array("message" => "Unable to add  product in the cart. Data is incomplete."));
          }
?>