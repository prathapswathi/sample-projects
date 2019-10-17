
<script type="text/javascript">
function CheckProduct(val){
 var element=document.getElementById('pro');
 if(val=='Select Product'||val=='others')
   element.style.display='block';
 else  
   element.style.display='none';
}

</script> 
 
<?php
// include database and object files
include_once 'libs/config/database.php';
include_once 'objects/product.php';
include_once 'file_handle.php';

$database = new Database();
$db = $database->getConnection();
$id=$conn->insert_id;

$product = new Product($db);
$file = new File();
$page_title = "Create Product";

include_once "header.php";
 
echo "<div class='right-button-margin'  >";
    echo "<a href='index.php' class='btn btn-default pull-right' style='background-color:lightgray'>Products</a>";
   
    echo "</div>";
    echo $id;
?>

<?php 

if($_POST){  
    $product->Products = $_POST['Products'];
    $product->Product_part = $_POST['Product_part'];
    $product->chap_id = $_POST["chap_id"];
    
    $file->id=$_POST["chap_id"];
    $file->Product_part = $_POST["Product_part"];
   
    $file->myeditor = $_POST["myeditor"];
   
   if($product->create() &&  $file->fileCreate() ){
        //file_put_contents($file, $editor); 
        echo "<div class='alert alert-success'>Product was created.</div>";
    }
 
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>
 
<form name="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      
    
    <table class='table table-hover table-responsive table-bordered'>
   
        
        
    <tr>
    <?php

    echo "<td>Products</td>";
    echo "<td>";
        $stmt = $product->read();
        
        // put them in a select drop-down
        echo "<select class='form-control' name='Products' id='sel' onchange='CheckProduct(this.value);' >";
            echo "<option>Select Product</option>";
        
            while ($row_product = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row_product);
                echo "<option value='{$Products}'>{$Products}</option>";
            }
            echo "<option value='others'>Other</option>";
        echo "</select>";
        ?>
        
        <input type="text" name="Products" id="pro" style='display:none;' required/>
        
    </tr>
    <tr>
        <td>Chapter Id
        <span style="color:red"> *</span></td>
       
        <td><input type='text' name='chap_id' class='form-control' />
        </tr>
        <tr>
            <td>Chapter Name
            <span style="color:red"> *</span></td>
            </td>
            <td><input type='text' name='Product_part' class='form-control' /></td>
        </tr>
        <!-- <tr>
     <td>  Section title:
    <span class="required" style="color:red">*</span></td>
    <td><input type="text" name="title" id="title" required></td>
    </tr> -->
    <tr>
    <td>Content:
    <span style="color:red"> *</span></td>
    <td>
<!-- creating a text area for my editor in the form -->
   <textarea id="myeditor" name="myeditor" required></textarea>
   </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary" >Create</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 
// footer
include_once "footer.php";
?>
