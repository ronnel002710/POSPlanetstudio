<?php
include "config.php";
$filename = 'Sales-'.date('Y-m-d').'.csv';

// Select query
$query = "SELECT * FROM sales INNER JOIN sales_order ON sales.invoice_number=sales_order.invoice";
$result = mysqli_query($con,$query);
$employee_arr = array();

// file creation
$file = fopen($filename,"w");

$employee_arr = array("TRANSACTION ID","INVOICE","CASHIER","DATE PURCHASE","PRODUCT NAME","QTY","PRICE","SUB AMOUNT","AMOUNT TENDER","VAT","DISCOUNT"); 
fputcsv($file,$employee_arr); 
while($row = mysqli_fetch_assoc($result)){
    $transaction_id = $row['transaction_id'];
    $invoice = $row['invoice_number'];
    $cashier = $row['cashier'];
    $date = $row['date'];
    $dname = $row['dname'];
    $qty = $row['qty'];
    $price = $row['price'];
	$amount = $row['amount'];
	$cash = $row['cash'];
    $vat = $row['vat'];
    $type = $row['discount'];
    // Write to file 
    $employee_arr = array($transaction_id,$invoice,$cashier,$date,$dname,$qty,$price,$amount,$cash,$vat,$type);
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
