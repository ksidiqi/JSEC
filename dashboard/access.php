<?php 
	session_start();
	if(strcmp($_SESSION['account_type'], 'admin') != 0){		
		header( 'Location: ./../dashboardDev/index.html' );
	} else if (strcmp($_SESSION['account_type'], 'admin') == 0){	
		$host="localhost";
		$port=3306;
		$socket="";
		$user="root";
		$password="mysql5";
		$dbname="db";
		$con = new mysqli($host, $user, $password, $dbname) or die ('Could not connect to the database server' . mysqli_connect_error());
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$query = "SELECT * FROM users WHERE email='$username' AND type='admin'"; // AND password='$password'"; //detel from group
		$resutl = $con->query($query);
		if(!$resutl){
			header( 'Location: ./../403/index.html' );		
		}
	}
 ?>

