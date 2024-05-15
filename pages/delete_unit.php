<?php
 include_once'../conn.php';

$delete = $pdo->prepare("DELETE FROM product_unit WHERE unit_id = '".$_GET['id']." '");
if($delete->execute()){
    header('location:product_unit.php');
}


