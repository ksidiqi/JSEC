<?php 
	include('./connect.php');
	session_start();
	if(strcmp($_SESSION['account_type'], 'developer') != 0){		
		header( 'Location: ./../signin/index.html' );	
	} else if (strcmp($_SESSION['account_type'], 'developer') == 0){		
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$query = "SELECT * FROM users WHERE email='$username' AND type='developer'"; // AND password='$password'"; //detel from group
		$resutl = $con->query($query);
		if($resutl->num_rows == 0){
			session_destroy();
			header( 'Location: ./../signin/index.html' );

		}
	}
 ?>

