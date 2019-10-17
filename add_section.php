<?php

// include database and object files
include_once 'libs/config/database.php';
include_once 'objects/product.php';
include_once 'ckeditor/ckeditor.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$product->id = $id;
 
// read the details of product to be edited
$product->readOne();

$page_title = "Add Section";
include_once "header.php";

 echo $_POST["Products"];
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
echo "</div>";
 
?>

<?php 

if($_POST){
    $path = 'Chapters';
    $name = $_POST["title"];
    $file = "$name.html";
   
    $editor = $_POST["myeditor"];
    $product->Products = $_POST['Products'];
    $product->Product_part = $_POST['Product_part'];
    if(!is_file($file)){
        file_put_contents($file, $editor);    
        echo "<div class='alert alert-success'>Sections was Added.</div>";
    }
   
    else{
        echo "<div class='alert alert-danger'>Unable to Add Section.</div>";
    }
}
?>


<body>
<form action="add_section.php" method="post"> 
    <label>Book:</label>
    <input type='text' name='Products' value='<?php echo $product->Products; ?>' class='form-control' readonly/>
   <label>Section title:</label>
    <span class="required" style="color:red">*</span>
    <input type="text" name="title" id="title" required>
    <span style="color:red">Content *</span><br>

<!-- creating a text area for my editor in the form -->
   <textarea id="myeditor" name="myeditor" id="myeditor"></textarea>
   
<!-- creating a CKEditor instance called myeditor -->

<input type="submit" class="btn btn-success" name="submit"  value="Submit">
  
</form>
</body>
<?php
 
// footer
include_once "footer.php";
?>
