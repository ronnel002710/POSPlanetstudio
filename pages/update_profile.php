<?php
        session_start();
	$conn=mysqli_connect("localhost", "root", "", "3590879_inventory");
 
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		/* $image_name = $_FILES['profile']['name'];
		$image_temp = $_FILES['profile']['tmp_name'];
		 $firstname = $_POST['firstname'];
		$lastname = $_POST['lastname']; 
		$current = $_POST['current'];
		*/
		
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		mysqli_query($conn, "UPDATE `user` set `name` = '$fullname', `password` = '$password' WHERE `id` = '$id'") or die(mysqli_error());
		
		header("location: home.php");
	}
?>