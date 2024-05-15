<?php
 include_once'../conn.php';

$delete = $pdo->prepare("DELETE FROM category WHERE cat_id = '".$_GET['id']." '");
if($delete->execute()){
    header('location:product_category.php');
}


