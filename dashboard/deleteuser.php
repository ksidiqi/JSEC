<?php  //Start the Session
session_start();
//connecting to database
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="mysql5";
$dbname="db";

$con = new mysqli($host, $user, $password, $dbname) or die ('Could not connect to the database server' . mysqli_connect_error());
if (isset($_POST['email'])){
	$email = $_POST['email'];
	$query = "DELETE FROM users WHERE email='$email';";
	$result = $con->query($query) or die ('Could not connect to the database server' . $con->error );
	if ($con->affected_rows > 0){
		$query2 = "DELETE FROM users_groups WHERE user_email='$email';";
		$result2 = $con->query($query2) or die ('Could not connect to the database server' . $con->error );
		$_SESSION['message'] = ' You successfully deleted ' . $email;
		$_SESSION['alert'] = true;
		header("location: ./bootstrap-elements.html");
	}else {
		$_SESSION['message'] = ' ' .$email . ' does not exist, try again.';
		$_SESSION['alert'] = true;
		header("location: ./deleteuser.html"); //
	}
}
$con->close();
?>