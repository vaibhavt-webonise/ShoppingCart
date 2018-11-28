<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/DatabaseConnection.php';
    include_once '../../objects/Cart.php';


    $database = new DatabaseConnection();
    $db = $database->getConnection();
    $cart = new Cart($db);

    $result = $cart->show();

    $num = $result->rowCount();

      if($num > 0) {
       $cat_arr = array();
       $cat_arr['data'] = array();

       while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $cat_item = array(
           'Customer_Name' => $row['Customer_Name'],
           'Product_Name' => $row['Product_Name'],
           'Total' => $row['Total'],
           'Total_Discount' => $row['Total_Discount'],
           'Total_With_Discount'=>$row['Total_With_Discount'],
           'Total_Tax' => $row['Total_Tax'],
           'Total_With_Tax' => $row['Total_With_Tax'],
           'Grand_Total'=>$row['Grand_Total']
         );

         array_push($cat_arr['data'], $cat_item);
       }

       echo json_encode($cat_arr);

 } else {
       echo json_encode(
         array('message' => 'No Products Found')
       );
 }
?>