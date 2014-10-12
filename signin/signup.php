<?php  //Start the Session
session_start();
//connecting to database
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="mysql5";
$dbname="db";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
	


if (isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['password1']) and isset($_POST['password2'])){

	$first = addslashes($_POST['first_name']);
	$last = addslashes($_POST['last_name']);
	$email = addslashes($_POST['email']);
	$password1 = addslashes($_POST['password1']);
	$password2 = addslashes($_POST['password2']);

	$result = $con->query("SELECT * FROM `users` WHERE email='$email'");
	$count = $result->num_rows;

	if ($count > 0){
	  $_SESSION['message'] = " user already registered with that email";
	  $_SESSION['alert'] = true;
	}
	if ($count == 0) {
		$query = "INSERT INTO `users` (first_name, last_name, email, password, type) VALUES('$first','$last','$email','$password1', 'developer')";
		$result = $con->query($query); 
		header("location: ./index.html"); //	
	}

}


?>