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
		// The message

		$email = addslashes($_POST['email']);
		$query = "SELECT * FROM `users` WHERE email='$email'";
		$result = $con->query($query);
		$row = $result->fetch_array(MYSQLI_ASSOC);		
		$password = $row['password'];		
		$message = "Your password for your JSEC (JavaScript Error Collector-team6) account is : " . $password;

		// In case any of our lines are larger than 70 characters, we should use wordwrap()
		$message = wordwrap($message, 70, "\r\n");

		// Send
		if($password){
			mail($email, 'JSEC Password', $message);
			$_SESSION['message'] = ' an Email has been send your email. Please check your Junck folder is probably there'; 
			$_SESSION['alert'] = true;
			header( 'Location: ./index.html' );
		} else {
			$_SESSION['message'] = ' No juch account exist in our database. Please sign up is FREE! and we will not steal your password :) '; 
			$_SESSION['alert'] = true;
			header( 'Location: ./signup.html' );
		}


?>