<?php
class Categories
{
    public $name;
    public $description;
    public $tax;
    private $conn;
    private $table_name="Categories";
    public function __construct($db)
    {

      $this->conn=$db;
    }
    function read()
    {
        $query = 'SELECT Name,Description,Tax FROM ' . $this->table_name;
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
   }
   function create(){

      $query = "INSERT INTO
                " . $this->table_name . "
            SET
                Name=:name, Description=:description, Tax=:tax";
      $stmt = $this->conn->prepare($query);
      $this->name=htmlspecialchars(strip_tags($this->name));
      $this->description=htmlspecialchars(strip_tags($this->description));
      $this->tax=htmlspecialchars(strip_tags($this->tax));
      $stmt->bindParam(":name", $this->name);
      $stmt->bindParam(":description", $this->description);
      $stmt->bindParam(":tax", $this->tax);

     // echo $this->description;

     // echo $this->tax;
      if($stmt->execute()){
        return true;
      }
      return false;
    }
    function update()
    {
        $query="UPDATE ".$this->table_name.
        " SET
            Description=:description,
            Tax=:tax
        WHERE
            Name=:name";

        $stmt = $this->conn->prepare($query);
      $this->name=htmlspecialchars(strip_tags($this->name));
      $this->description=htmlspecialchars(strip_tags($this->description));
      $this->tax=htmlspecialchars(strip_tags($this->tax));

      $stmt->bindParam(":description", $this->description);
      $stmt->bindParam(":tax", $this->tax);
      $stmt->bindParam(":name", $this->name);

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
            Name=:name";

        $stmt = $this->conn->prepare($query);
        $this->name=htmlspecialchars(strip_tags($this->name));
        $stmt->bindParam(":name", $this->name);

        if($stmt->execute()){
          return true;
        }
          return false;
    }
}
?>