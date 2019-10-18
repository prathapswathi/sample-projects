<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'libs/config/database.php';
    include_once 'objects/product.php';
    include_once 'file_handle.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare product object
    $product = new Product($db);
    
    $file = new file($db);
     
    // set product id to be deleted
    $product->id = $_POST['object_id'];
    $file->id = $_POST['object_id'];

    $file->fileget();
     
    // delete the product
    if($product->delete() && $file->delete()){
        echo "Object was deleted.";
    }
     
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>