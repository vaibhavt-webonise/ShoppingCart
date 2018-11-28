<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/DatabaseConnection.php';
    include_once '../../objects/Product.php';


    $database = new DatabaseConnection();
    $db = $database->getConnection();
    $product = new Product($db);

    $result = $product->read();

    $num = $result->rowCount();

      if($num > 0) {
       $cat_arr = array();
       $cat_arr['data'] = array();

       while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $cat_item = array(
           'Product_Name' => $row['Product_Name'],
           'Description' => $row['Description'],
           'Price' => $row['Price'],
           'Discount' => $row['Discount'],
           'Category_Name'=>$row['Category_Name']
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