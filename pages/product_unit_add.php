<?php
session_start();
 $conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
		  if(isset($_POST['submit'])){
				$unit = $_POST['unit'];

				$sql = "SELECT * FROM product_unit WHERE unit = '$unit'";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$_SESSION['error'] = "New unit  was already exist!";
				}
				else{
					$sql = "INSERT INTO product_unit (unit) VALUES ('$unit')";
					if($conn->query($sql)){
						$_SESSION['success'] = 'New unit added successfully';
					}
					else{
						$_SESSION['error'] = $conn->error;
					}
				}
			}	
			else{
				$_SESSION['error'] = 'Fill up add form first';
			}

	header('location: product_unit.php');
?>