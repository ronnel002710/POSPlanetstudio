<?php
session_start();
include('connect.php');
$a = $_POST['fname'];
$e = $_POST['mname'];
$f = $_POST['lname'];
$b = $_POST['address'];
$c = $_POST['contact'];

// query
$sql = "INSERT INTO customer (first_name,address,contact,last_name,middle_name,customer_name) VALUES (:a,:b,:c,:e,:f,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':e'=>$f,':f'=>$e,':h'=>$a.' '.$e.' '.$f ));
header("location: customer.php");


?>