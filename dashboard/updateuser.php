<?php
	session_start();
	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="mysql5";
	$dbname="db";
	$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());	
	if (isset($_POST['email']) ){
		$email = $_POST['email'];
		$query = "SELECT * FROM `users` WHERE email='$email'";		 
		$result = $con->query($query);
		$count = $result->num_rows;	
		if ($count == 1){
			$row = mysqli_fetch_array($result);
			$_SESSION['edituser_id'] = $row['id'];
			$_SESSION['edituser_first'] = $row['first_name'];
			$_SESSION['edituser_last'] = $row['last_name'];
			$_SESSION['edituser_email'] = $row['email'];
			header("location: ./edituser2.html");
		}else{
			$_SESSION['message'] = 'No such User exist, check the email and try again.';
			$_SESSION['alert'] = true;
			header("location: ./edituser.html");
		}
	}
	else {
		$_SESSION['message'] = 'Enter user email';
		$_SESSION['alert'] = true;
		header("location: ./edituser.html"); //
	}
?>