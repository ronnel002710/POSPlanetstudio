<?php
	session_start();
 $conn = new mysqli('localhost', 'root', '', '3590879_inventory');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
		  if(isset($_POST['user_add'])){
				$a = $_POST['user'];
				$b = $_POST['pass'];
				$c = $_POST['name'];
				$d = $_POST['post'];
				$e = "DeActive";	
				$sql = "SELECT * FROM cashier WHERE username = '$a'";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$_SESSION['error'] = "New username  was already exist!";
				}
				else{
					$sql = "INSERT INTO cashier (username,password,cashier_name,position,status) VALUES ('$a','$b','$c','$d','$e')";
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

	header('location: user.php');
?>