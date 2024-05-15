<?php
	include('connect.php');
	$id=$_GET['transaction_id'];
	$invoice=$_GET['invoice'];
	$cash=$_GET['cash'];
	$qty=$_GET['qty'];
	$wapak=$_GET['productcode'];
	//edit qty
	$sql = "UPDATE products 
			SET qty_left=qty_left+?
			WHERE product_code=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$wapak));

	$result = $db->prepare("UPDATE sales_order SET SET qty_left=qty_left+ WHERE transaction_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	header("location: sales.php?id=$cash&invoice=$invoice");
?>