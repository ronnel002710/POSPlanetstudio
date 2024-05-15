<?php
session_start();
include('connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];
$cname = $_POST['cname'];
$p = $_POST['customers'];


$date = date('F d, Y');

$dmonth = date('F');
$dyear = date('Y');


if($d=='cash') {
	$f = $_POST['cash'];
	$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,cash,name,month,year,customer_name) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:p)";
	$q = $db->prepare($sql);
	$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$cname,':h'=>$dmonth,':i'=>$dyear,'p'=>$p));
	header("location: preview.php?invoice=$a");
	exit();
}
// query

?>