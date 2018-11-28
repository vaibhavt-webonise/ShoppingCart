<?php
  class Product
  {
    public $product_name;
    public $product_description;
    public $price;
    public $discount;
    public $category;
    private $conn;
    private $table_name="Products";
    public function __construct($db)
    {

      $this->conn=$db;
    }
    function read()
    {
        $query = 'SELECT Product_Name,Description,Price,Discount,Category_Name FROM ' . $this->table_name;
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
   }
   function create(){
      $query = "INSERT INTO
                " . $this->table_name . "
            SET
                Product_Name=:product_name, Description=:product_description, Price=:price, Discount=:discount, Category_Name=:category";
      $stmt = $this->conn->prepare($query);
      $this->product_name=htmlspecialchars(strip_tags($this->product_name));
      $this->product_description=htmlspecialchars(strip_tags($this->product_description));
      $this->price=htmlspecialchars(strip_tags($this->price));
      $this->discount=htmlspecialchars(strip_tags($this->discount));
      $this->category=htmlspecialchars(strip_tags($this->category));
      $stmt->bindParam(":product_name", $this->product_name);
      $stmt->bindParam(":product_description", $this->product_description);
      $stmt->bindParam(":price", $this->price);
      $stmt->bindParam(":discount", $this->discount);
      $stmt->bindParam(":category", $this->category);


      if($stmt->execute()){
        return true;
      }
      return false;
    }
    function update()
    {
        $query="UPDATE ".$this->table_name.
        " SET
            Description=:product_description,
            Price=:price,
            Discount=:discount,
            Category_Name=:category
        WHERE
            Product_Name=:product_name";

        $stmt = $this->conn->prepare($query);
        $this->product_description=htmlspecialchars(strip_tags($this->product_description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->discount=htmlspecialchars(strip_tags($this->discount));
        $this->category=htmlspecialchars(strip_tags($this->category));
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));

        $stmt->bindParam(":product_description", $this->product_description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":discount", $this->discount);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":product_name", $this->product_name);

        if($stmt->execute()){
          return true;
        }
          return false;
    }

    function delete()
    {
        $query="DELETE FROM ".$this->table_name.
        "
          WHERE
            Product_Name=:product_name";

        $stmt = $this->conn->prepare($query);
        $this->product_name=htmlspecialchars(strip_tags($this->product_name));
        $stmt->bindParam(":product_name", $this->product_name);

        if($stmt->execute()){
          return true;
        }
          return false;
    }
  }

?>