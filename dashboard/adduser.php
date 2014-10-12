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

	$first = $_POST['first_name'];
	$last = $_POST['last_name'];
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$priv = $_POST['privilege'];

	$result = $con->query("SELECT * FROM `users` WHERE email='$email'");
	$count = $result->num_rows;

	if (strcmp($password1, $password2) != 0) {
		$_SESSION['message'] = 'Your password doesn not match, try again.';
		$_SESSION['alert'] = true;
		header("location: ./adduser.html"); //	
	}else if ($count > 0){
		$_SESSION['message'] = 'Account already exist with that email';
		$_SESSION['alert'] = true;
		header("location: ./adduser.html"); //
	}
	else if ($count == 0) {
		$query = "INSERT INTO `users` (first_name, last_name, email, password, type) VALUES('$first','$last','$email','$password1', '$priv')";
		$result = $con->query($query); 
		$_SESSION['message'] = 'You have successfully created an account!';
		$_SESSION['alert'] = true;
		header("location: ./bootstrap-elements.html"); //	
	}

}

if (!$result){
	echo "something wrong";
}

?>