<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/DatabaseConnection.php';
    include_once '../../objects/Cart.php';


    $database = new DatabaseConnection();
    $db = $database->getConnection();
    $cart = new Cart($db);


    $data = json_decode(file_get_contents("php://input"));


    $cart->customer_name=$data->Customer_Name;
    $result = $cart->getTotalDiscount();
    $row = $result->fetch(PDO::FETCH_ASSOC);
      if(!($row['Total_Discount']=="")) {
         echo json_encode(array('Total_Discount'=>$row['Total_Discount']));
      }
      else {
          echo json_encode(
          array('message' => 'No User Found')
       );
 }
?>