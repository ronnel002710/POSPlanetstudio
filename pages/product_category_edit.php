<?php
session_start();
$conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_POST['btn_edit'])){
		$id = $_POST['id'];
		$category = $_POST['category'];
		$sql = "UPDATE category SET cat_name = '$category' WHERE cat_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Category updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: product_category.php');
?>