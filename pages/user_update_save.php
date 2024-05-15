<?php
 session_start();
 $conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_POST['user_update'])){
		$id = $_POST['id'];
		$pass = $_POST['pass'];
		$name = $_POST['name'];
		$status = $_POST['status'];
		$sql = "UPDATE cashier SET password = '$pass', cashier_name='$name', status='$status' WHERE cashier_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'user information updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to update first';
	}

	header('location: user.php');
?>