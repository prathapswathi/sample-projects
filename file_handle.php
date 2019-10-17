<?php
Class file{


private $conn;
private $table_name = "books";

public $id;
public $Product_part;
public $title;
public $myeditor;

public function __construct($db){
    $this->conn = $db;
}

public function fileCreate()
{
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->Product_part=htmlspecialchars(strip_tags($this->Product_part));
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->myeditor=htmlspecialchars(strip_tags($this->myeditor));
    $fileName='./Chapters/'.$this->id." ".$this->Product_part.".html";
    $file = str_replace(' ', '_', $fileName);
    if(!is_file($file)){
        file_put_contents($file, $this->myeditor);
        return true; 
    }
   else
   return false;
}
public function fileget()
{

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

    //$this->id=htmlspecialchars(strip_tags($this->chap_id));
    //$this->Product_part=htmlspecialchars(strip_tags($this->Product_part));
    // $this->title=htmlspecialchars(strip_tags($this->title));
    // $this->myeditor=htmlspecialchars(strip_tags($this->myeditor));
   // $dir='/Chapters';
    $fileName=$this->chap_id." ".$this->Product_part.".html";
    $file = str_replace(' ', '_', $fileName);
    $this->myeditor = $file;
    
   // $this->Product_part = $this->Product_part;
  //  $this->chap_id = $this->id;
   // $myeditor =  file_get_contents($file, $this->myeditor);

}
public function update()
{
    $this->chap_id=htmlspecialchars(strip_tags($this->chap_id));
    $this->Product_part=htmlspecialchars(strip_tags($this->Product_part));
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->myeditor=htmlspecialchars(strip_tags($this->myeditor));

    $fileName=$this->chap_id." ".$this->Product_part.".html";
    $file = str_replace(' ', '_', $fileName);
   // $path ='/Chapters/'.$file;
   // $content = file_get_contents($path);
    //$data_to_write.= $_POST[myeditor]."\n";
    //file_put_contents($path, $this->myeditor);
   if( file_put_contents('./Chapters/'.$file, $this->myeditor))
   {
       return true;
   }
    else
    {
        return false;
    }  
}
}
?>
