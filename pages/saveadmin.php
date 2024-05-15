<?php
session_start();
include('connect.php');
$a = $_POST['user'];
$b = $_POST['pass'];
$c = $_POST['name'];
$d = "Deactive";
$sql = "INSERT INTO user (username,password,firstname,status) VALUES (?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d));
header("location: home.php");
?>