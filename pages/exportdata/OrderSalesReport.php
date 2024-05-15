<?php
include "config.php";
$filename = 'AllSalesOrder-'.date('Y-m-d').'.csv';

// Select query
$query = "SELECT * FROM sales_order ORDER BY transaction_id asc";
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
