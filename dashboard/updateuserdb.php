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
	


if (isset($_POST['email']) and isset($_POST['password1']) and isset($_POST['password2'])){
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$privilege = $_POST['privilege'];
	
	$id = $_SESSION['edituser_id'];	
	$preemail = $_SESSION['edituser_email'];
	//for future uses 
	$_SESSION['edituser_id'] = "";
	$_SESSION['edituser_email'] = "";
	
	if(strcmp($password1, $password2) == 0){
		$result = $con->query("UPDATE users SET email='$email', password='$password1' , type='$privilege' WHERE id='$id'");
		$result2 = $con->query("UPDATE users_groups SET user_email='$email' WHERE user_email='$preemail'");
		$result3 = $con->query("UPDATE comments SET user_email='$email' WHERE user_email='$preemail'");
		header("location: ./index.html"); //
	}
	else {
		$_SESSION['message'] = ' Passwords do not match.';
		$_SESSION['alert'] = true;
		header("location: ./edituser.html"); 
	}
}


?>