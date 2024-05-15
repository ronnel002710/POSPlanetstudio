<?php
session_start();
include('connect.php');
$a = $_POST['code'];
$b = $_POST['bname'];
$c = $_POST['cost'];
$d = $_POST['price'];
$e = $_POST['qty'];
$f = $_POST['categ'];
$g = $_POST['date_del'];
$h = $_POST['ex_date'];
$i = $_POST['dname'];
$j = $_POST['unit'];
$sql = "INSERT INTO products (product_code,product_name,cost,price,qty_left,category,date_delivered,expiration_date,description_name,unit) VALUES (?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d,$e,$f,$g,$h,$i,$j));
header("location: products.php");


?>