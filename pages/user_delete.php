<?php
	session_start();
 $conn = new mysqli('localhost', 'root', '', '3590879_inventory');
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
   $sql = "DELETE FROM cashier WHERE cashier_id = '".$_GET['id']."'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'User has been successfully deleted!';
		header('location: user.php');
	}
	else{
		$_SESSION['error'] = $conn->error;
	}
	
?>