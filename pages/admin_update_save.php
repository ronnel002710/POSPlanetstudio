<?php
 session_start();
 $conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_POST['admin_update'])){
		$id = $_POST['id'];
		$pass = $_POST['pass'];
		$firstname = $_POST['firstname'];
		$status = $_POST['status'];
		$sql = "UPDATE user SET password = '$pass', firstname='$firstname', status='$status' WHERE id = '$id'";
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

	header('location: admin.php');
?>