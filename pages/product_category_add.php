<?php
session_start();
  $conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
		  if(isset($_POST['submit'])){
				$cat_name = $_POST['category'];

				$sql = "SELECT * FROM category WHERE cat_name = '$cat_name'";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$_SESSION['error'] = "New Category  was already exist!";
				}
				else{
					$sql = "INSERT INTO category (cat_name) VALUES ('$cat_name')";
					if($conn->query($sql)){
						$_SESSION['success'] = 'New Category added successfully';
					}
					else{
						$_SESSION['error'] = $conn->error;
					}
				}
			}	
			else{
				$_SESSION['error'] = 'Fill up add form first';
			}

	header('location: product_category.php');
?>