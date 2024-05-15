<?php
session_start();
include('connect.php');
$a = $_POST['user'];
$b = $_POST['pass'];
$c = $_POST['name'];
$d = $_POST['post'];
$e = "DeActive";
$sql = "INSERT INTO cashier (username,password,cashier_name,position,status) VALUES (?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d,$e));
header("location: home.php");
?>