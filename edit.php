<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$file = $_GET['file'];
$content = $_GET['content'];
// include database and object files
include_once 'libs/config/database.php';
include_once 'objects/product.php';
include_once 'file_handle.php';
//include_once 'create_product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$product = new Product($db);
$file = new file($db);

 
// set ID property of product to be edited
$product->id = $id;
$file->id = $id;
 
// read the details of product to be edited
$product->readOne();
$file->fileget();

?>
<?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $product->Products = $_POST['Products'];
    $product->chap_id = $_POST['chap_id'];
    $product->Product_part = $_POST['Product_part'];
 
    //set property for file
    $file->Product_part= $_POST['Product_part'];
    $file->chap_id = $_POST['chap_id'];
    $file->myeditor = $_POST['myeditor'];

    // update the product
    if($file->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Product content was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update product.";
        echo "</div>";
    }
}
?>
 

<?php
 
// set page header
$page_title = "Update Product";
include_once "header.php";
 
echo "<div class='right-button-margin' >";
    echo "<a href='index.php' class='btn btn-default pull-right' style='background-color:lightgray'>Products</a>";
echo "</div>";

?>
<button type="button" style="background-color:orange;color:white">Edit Product</button>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Products</td>
            <td><input type='text' name='Products' value='<?php echo $product->Products; ?>' class='form-control' readonly/></td>
        </tr>
 
        <tr>
            <td>Chapter</td>
            <td><input type='text' name='Product_part' value='<?php echo $product->Product_part; ?>' class='form-control' readonly/></td>
        </tr>
        <tr>
            <td>Chapter id</td>
            <td><input type='text' name='chap_id' value='<?php echo $product->chap_id; ?>' class='form-control' readonly/></td>
        </tr>
        <!-- <tr>
            <td>Section</td>
            <td><input type='text' name='title' value='<?php echo $file->Product_part; ?>' class='form-control' /></td>
        </tr> -->
        <tr>
            <td>Content</td>
           <!-- // <td><textarea id="myeditor" name="myeditor" id="myeditor" value='<?php file_get_contents('./Chapter/'.$myeditor);?>'></textarea></td> -->
         <td>  <textarea  id="myeditor" name="myeditor"><?php echo file_get_contents('./Chapters/'.$file->myeditor) ; ?></textarea></td>
          
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "footer.php";
?>