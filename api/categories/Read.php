<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/DatabaseConnection.php';
    include_once '../../objects/Categories.php';


    $database = new DatabaseConnection();
    $db = $database->getConnection();
    $categories = new Categories($db);

    $result = $categories->read();

    $num = $result->rowCount();

      if($num > 0) {
       $cat_arr = array();
       $cat_arr['data'] = array();

       while($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $cat_item = array(
           'Name' => $row['Name'],
           'Description' => $row['Description'],
           'Tax' => $row['Tax']
         );

         array_push($cat_arr['data'], $cat_item);
       }

       echo json_encode($cat_arr);

 }
 else {
       echo json_encode(
         array('message' => 'No Categories Found')
       );
 }
?>