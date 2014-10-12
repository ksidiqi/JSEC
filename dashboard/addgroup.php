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
	


if (isset($_POST['group_name']) and isset($_POST['email']) ){

	$name = $_POST['group_name'];
	$email = $_POST['email'];

	$result = $con->query("SELECT * FROM `users` WHERE email='$email'");
	$count = $result->num_rows;

	if ($count != 1){
		$_SESSION['message'] = ' ' .$email . ' does not exist, try adding someone who already has account or make one for him/her.';
		$_SESSION['alert'] = true;
		header("location: ./addgroup.html");
	}
	if ($count == 1) {
		$query = "SELECT * FROM `groups` WHERE name='$name'";
		$result = $con->query($query); 
		$count = $result->num_rows;
		if($count > 0){
			$_SESSION['message'] = ' ' .$name . ' already exists try adding a new group ';
			$_SESSION['alert'] = true;
			header("location: ./addgroup.html");
		} else {
			$query = "INSERT INTO `groups` (name) VALUES('$name')";
			$result = $con->query($query); 
			$query = "INSERT INTO `users_groups` (user_email, group_name, role) VALUES('$email','$name', 'manager')";
			$result = $con->query($query);
			if($con->affected_rows > 0){
				$_SESSION['message'] = ' ' . $name . ' was created, and '. $email . ' is the new developer manager.';
				$_SESSION['alert'] = true;
				header("location: ./bootstrap-elements.html"); //	
			}
		}
	}

}

if (!$result){
	echo "something wrong";
}

?>