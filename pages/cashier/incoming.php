<?php
session_start();
include('connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$r = $_POST['vat'];
$date = date('Y-m-d');
$month = date('F');
$year = date('Y');
$p = $_POST['customers'];


$result = $db->prepare("SELECT * FROM customer WHERE customer_name= :userid");
$result->bindParam(':userid', $p);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$customer_name=$row['customer_name'];
}


$discount = $_POST['discount'];
$result = $db->prepare("SELECT * FROM products WHERE product_code= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$name=$row['product_name'];
$dname=$row['description_name'];
$categ=$row['category'];
$qtyleft=$row['qty_left'];
}


//edit qty
$sql = "UPDATE products 
        SET qty_left=qty_left-?
		WHERE product_code=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
$fffffff=$asasa-$discount;
$d=$fffffff*$c;
$z=$qtyleft-$c;
$vat=$d*$r;
$total=$vat+$d;
// query
$sql = "INSERT INTO sales_order (invoice,product,qty,amount,name,price,discount,category,date,omonth,oyear,qtyleft,dname,vat,total_amount,customer_name) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$name,':f'=>$asasa,':g'=>$discount,':h'=>$categ,':i'=>$date,':j'=>$month,':k'=>$year,':l'=>$z,':m'=>$dname,':n'=>$vat,':o'=>$total,':p'=>$customer_name));
header("location: sales.php?id=$w&invoice=$a");



?>