<?php

    include_once '../config/DatabaseConnection.php';
    class Cart
    {
        public $customer_name;
        public $product_name;
        public $total;
        public $discount;
        public $total_discount;
        public $tax;
        public $total_tax;
        public $grand_total;

        private $conn;
        private $table_name="Cart";

        public function __construct($db)
        {
            $this->conn=$db;
        }

        function show()
        {
            $query = 'SELECT Customer_Name,Product_Name,Total,Total_Discount,Total_With_Discount,Total_Tax,Total_With_Tax,Grand_Total FROM ' . $this->table_name;
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement;
        }

        function create()
        {
                  $res=$this->getDiscount($this->product_name);
                  $res1=$this->getTax($res['Category_Name']);
                  $this->total=$res['Price'];
                  $this->discount=($res['Discount']/100)*$this->total;
                  $this->total_discount=$this->total-$this->discount;
                  $this->tax=($res1['Tax']/100)*$this->total;
                  $this->total_tax=$this->total-$this->tax;
                  $this->grand_total=$this->total_discount+ $this->tax;

                  $query = "INSERT INTO ".$this->table_name." SET Customer_Name=:customer_name,Product_Name=:product_name,Total=:total,Total_Discount=:total_discount,Total_With_Discount=:total_with_discount,Total_Tax=:total_tax,Total_With_Tax=:total_with_tax,Grand_Total=:grand_total";


                  $stmt = $this->conn->prepare($query);
                  $this->customer_name=htmlspecialchars(strip_tags($this->customer_name));
                  $this->product_name=htmlspecialchars(strip_tags($this->product_name));
                  $this->total=htmlspecialchars(strip_tags($this->total));
                  $this->discount=htmlspecialchars(strip_tags($this->discount));
                  $this->total_discount=htmlspecialchars(strip_tags($this->total_discount));
                  $this->tax=htmlspecialchars(strip_tags($this->tax));
                  $this->total_tax=htmlspecialchars(strip_tags($this->total_tax));
                  $this->grand_total=htmlspecialchars(strip_tags($this->grand_total));

                  $stmt->bindParam(":customer_name", $this->customer_name);
                  $stmt->bindParam(":product_name", $this->product_name);
                  $stmt->bindParam(":total", $this->total);
                  $stmt->bindParam(":total_discount", $this->discount);
                  $stmt->bindParam(":total_with_discount", $this->total_discount);
                  $stmt->bindParam(":total_tax", $this->tax);
                  $stmt->bindParam(":total_with_tax", $this->total_tax);
                  $stmt->bindParam(":grand_total", $this->grand_total);


                  if($stmt->execute()){
                        return true;
                  }
                  return false;
        }
        function getDiscount($pname){
              $query = "SELECT Price,Discount,Category_Name From Products WHERE Product_Name='".$pname."'";
              $statement = $this->conn->prepare($query);
              $statement->execute();
              $row = $statement->fetch(PDO::FETCH_ASSOC);
              return $row;
        }
        function getTax($cname){
              $query = "SELECT Tax From Categories WHERE Name='".$cname."'";
              $statement = $this->conn->prepare($query);
              $statement->execute();
              $row = $statement->fetch(PDO::FETCH_ASSOC);
              return $row;
        }
        function delete()
        {
          $query="DELETE FROM ".$this->table_name.
          "
            WHERE
              Product_Name=:product_name Limit 1";

            $stmt = $this->conn->prepare($query);
            $this->product_name=htmlspecialchars(strip_tags($this->product_name));
            $stmt->bindParam(":product_name", $this->product_name);

          if($stmt->execute()){
            return true;
          }
          return false;
        }
        function getTotalBill()
        {

            $query="SELECT SUM(Grand_Total) As Total_Bill FROM Cart WHERE Customer_Name='".$this->customer_name."'";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement;
        }
        function getTotalDiscount()
        {

            $query="SELECT SUM(Total_Discount) As Total_Discount FROM Cart WHERE Customer_Name='".$this->customer_name."'";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement;
        }
        function getTotalTax()
        {

            $query="SELECT SUM(Total_Tax) As Total_Tax FROM Cart WHERE Customer_Name='".$this->customer_name."'";
            $statement = $this->conn->prepare($query);
            $statement->execute();
            return $statement;
        }
    }


?>