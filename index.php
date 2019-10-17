<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once 'libs/config/database.php';
include_once 'objects/product.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// query products
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// set page header
$page_title = "Products";
include_once "header.php";
 
// contents will be here
echo "<div class='right-button-margin'>
    <a href='create_product.php' class='btn btn-default pull-right' style='background-color:lightblue'>Create Product</a>
</div>";
// display the products if there are any
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr style='background-color:green'>";
            echo "<th>Product</th>";
            echo "<th>Content</th>";
            echo "<th>Modify</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$Products}</td>";
                echo "<td>{$Product_part}</td>";
                echo "<td>";
                    // read one, edit and delete button will be here

                // read, edit and delete buttons
				echo "<a href='read.php?id={$id}' class='btn btn-primary left-margin'>
    			<span class='glyphicon glyphicon-list'></span> Read
				</a>
 
				<a href='edit.php?id={$id}' class='btn btn-info left-margin'>
    			<span class='glyphicon glyphicon-edit'></span> Edit
				</a>
 
				<a delete-id='{$id}' class='btn btn-danger delete-object'>
    			<span class='glyphicon glyphicon-remove'></span> Delete
				</a> ";

                // <a href='add_section.php?id={$id}' class='btn btn-info left-margin'>
    			// <span class='glyphicon glyphicon-plus'></span> Add Section
                // </a>
               

                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons will be here
    // the page where this paging is used
$page_url = "index.php?";
 
// count all products in the database to calculate total pages
$total_rows = $product->countAll();
 
// paging buttons here
include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}
 
// set page footer
include_once "footer.php";
?>
