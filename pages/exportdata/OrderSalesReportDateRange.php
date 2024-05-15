<?php
include "config.php";
$filename = 'SalesOrder-'.$from_date = $_POST['from_date'].'-'.$to_date = $_POST['to_date'].'.csv';

// POST values
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

// Select query
$query = "SELECT * FROM sales_order ORDER BY transaction_id asc";

if(isset($_POST['from_date']) && isset($_POST['to_date'])){
	$query = "SELECT * FROM sales_order where date between '".$from_date."' and '".$to_date."' ORDER BY transaction_id asc";
}

$result = mysqli_query($con,$query);
$employee_arr = array();

// file creation
$file = fopen($filename,"w");

$employee_arr = array("TRANSACTION ID","INVOICE","PRODUCT CODE","QUANTITY","AMOUNT","BRAND","PRICE","CATEGORY","DATE PURCHASE","QUANTITY LEFT","PRODUCT NAME","TOTAL AMOUNT"); 
fputcsv($file,$employee_arr); 
while($row = mysqli_fetch_assoc($result)){
    $transaction_id = $row['transaction_id'];
    $invoice = $row['invoice'];
    $product = $row['product'];
    $qty = $row['qty'];
    $amount = $row['amount'];
    $name = $row['name'];
    $price = $row['price'];
    $category = $row['category'];
    $date = $row['date'];
    $qtyleft = $row['qtyleft'];
    $dname = $row['dname'];
    $total_amount = $row['total_amount'];

    // Write to file 
    $employee_arr = array($transaction_id,$invoice,$product,$qty,$amount,$name,$price,$category,$date,$qtyleft,$dname,$total_amount);
    fputcsv($file,$employee_arr); 
}

fclose($file); 

// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/csv; "); 

readfile($filename);

// deleting file
unlink($filename);
exit();
