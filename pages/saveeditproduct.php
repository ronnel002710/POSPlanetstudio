<?php
// configuration
include('connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['code'];
$b = $_POST['bname'];
$c = $_POST['cost'];
$d = $_POST['price'];
$e = $_POST['supplier'];
$f = $_POST['categ'];
$i = $_POST['dname'];
$g = $_POST['qty'];
// query
$sql = "UPDATE products 
SET product_code=?, product_name=?, cost=?, price=?, supplier=?, category=?, description_name=?, qty_left=?
WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d,$e,$f,$i,$g,$id));
header("location: products.php");

?>