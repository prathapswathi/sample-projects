<?php
include_once 'libs/config/database.php';
include_once 'objects/product.php';
include_once 'file_handle.php';

$database = new Database();
$db = $database->getConnection();
//$id = $conn->lastInsertId();
//$id = mysql_insert_id();
$product = new Product($db);
$id=$product->lastid ();
// while($row = mysql_fetch_array($stmt))
// {
// $id=$row['id'];
// }

// $row = $stmt->fetch_array();
// print $row['id'];
echo $id;
echo "hai";
?>