<?php
	session_start(); 
	if(isset($_POST['error_id'])){
		$host="localhost";
		$port=3306;
		$socket="";
		$user="root";
		$password="mysql5";
     	$dbname="db";
		$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
		or die ('Could not connect to the database server' . mysqli_connect_error());
		$error_id = $_POST['error_id'];
		$result = $con->query("SELECT * FROM errors WHERE id= '$error_id'");
		if($error = $result->fetch_array(MYSQLI_ASSOC)){
			$_SESSION['error_id'] = $error['id'];
			header( 'Location: ./forms2.html' ) ;
		} else {
			echo "not found";
		}
	}
?>