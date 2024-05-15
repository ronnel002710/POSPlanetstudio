<?php
session_start();
  $conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_POST['btn_unit'])){
		$id = $_POST['id'];
		$unit = $_POST['unit'];
		$sql = "UPDATE product_unit SET unit = '$unit' WHERE unit_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Unit updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: product_unit.php');
?>