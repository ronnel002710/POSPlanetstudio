<?php
session_start();
include('connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];
$pamount = $_POST['p_amount'];
/* $cname = $_POST['cname']; */
$vat=$pamount*.0;


$date = date('Y-m-d');

$dmonth = date('F');
$dyear = date('Y');




if($d=='cash') {
	$f = $_POST['cash'];
	$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,cash,month,year,p_amount,vat) VALUES (:a,:b,:c,:d,:e,:f,:h,:i,:k,:j)";
	$q = $db->prepare($sql);
	$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':h'=>$dmonth,':i'=>$dyear,':k'=>$pamount,':j'=>$vat));
	header("location: preview.php?invoice=$a");
	exit();
}
// query

?>