<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "books";
 
    // object properties
    public $id;
    public $Products;
    public $chap_id;
    public $Product_part;
  
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create product
    function create(){
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    Products=:Products,chap_id=:chap_id, Product_part=:Product_part";
 
        $stmt = $this->conn->prepare($query);
        // posted values
        $this->Products=htmlspecialchars(strip_tags($this->Products));
        $this->chap_id=htmlspecialchars(strip_tags($this->chap_id));
        $this->Product_part=htmlspecialchars(strip_tags($this->Product_part));
        
        $stmt->bindParam(":Products", $this->Products);
        $stmt->bindParam(":chap_id", $this->chap_id);
        $stmt->bindParam(":Product_part", $this->Product_part);
        
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
  public  function read(){
        //select all data
        $query = "SELECT DISTINCT
                  Products 
                FROM
                    " . $this->table_name . " ";
                // ORDER BY
                //     Products";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
   
public function lastid()
{
    $query = "SELECT 
    MAX(id)
    FROM
       " . $this->table_name . " ";
     $stmt = $this->conn->prepare( $query );
     $stmt->execute();
  
     return $stmt;
}
public function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                id, Products,chap_id, Product_part
            FROM
                " . $this->table_name . "
            ORDER BY
                Products ASC
                LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
}
// used for paging products
public function countAll(){
 
    $query = "SELECT id FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
}
function readOne(){
 
    $query = "SELECT
                Products,chap_id, Product_part
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
             LIMIT
                 0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->Products = $row['Products'];
    $this->chap_id = $row['chap_id'];
    $this->Product_part = $row['Product_part'];
  
}
function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                Products = :Products,
                chap_id = :chap_id,
                Product_part = :Product_part
            WHERE
                id = :id";
 
    $stmt = $this->conn->prepare($query);
 
    // posted values
    $this->Products=htmlspecialchars(strip_tags($this->Products));
    $this->chap_id=htmlspecialchars(strip_tags($this->chap_id));
    $this->Product_part=htmlspecialchars(strip_tags($this->Product_part));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind parameters
    $stmt->bindParam(':Products', $this->Products);
    $stmt->bindParam(':chap_id', $this->chap_id);
    $stmt->bindParam(':Product_part', $this->Product_part);
    $stmt->bindParam(':id', $this->id);
    
    

    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// delete the product
function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
}
?>
