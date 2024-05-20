<?php
	session_start();
 $conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
		  if(isset($_POST['admin_add'])){
				$a = $_POST['user'];
				$b = $_POST['pass'];
				$c = $_POST['name'];
				$sql = "SELECT * FROM user WHERE username = '$a'";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$_SESSION['error'] = "New username  was already exist!";
				}
				else{
					$sql = "INSERT INTO user (username,password,firstname,role) VALUES ('$a','$b','$c','Admin')";
					if($conn->query($sql)){
						$_SESSION['success'] = 'New username added successfully';
					}
					else{
						$_SESSION['error'] = $conn->error;
					}
				}
			}	
			else{
				$_SESSION['error'] = 'Fill up add form first';
			}

	header('location: admin.php');
?>