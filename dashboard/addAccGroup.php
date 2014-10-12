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
	


	if (isset($_POST['email'])){

		$email = $_POST['email'];
		$group = $_POST['group'];
		$role = $_POST['role'];

		$result = $con->query("SELECT * FROM `users` WHERE email='$email'");
		$count = $result->num_rows;

		if ($count == 0){
			$_SESSION['message'] = 'Account does not exist';
			$_SESSION['alert'] = true;
			header("location: ./addAccGroup.html"); //
		}
		
		if ($count == 1) {
			$query = "SELECT * FROM `users_groups` WHERE user_email='$email' AND role='developer'";
			$result = $con->query($query);
			$result2 = $con->query("SELECT * FROM `users_groups` WHERE user_email='$email' AND role='manager'");
			if($result->num_rows > 0){
				$_SESSION['message'] = ' '.$email . ' is already a developer in another group group';
				$_SESSION['alert'] = true;
				header("location: ./addAccGroup.html");
			} else if ( $result2->num_rows > 0 ){
				$_SESSION['message'] = ' '.$email . ' is already a manager in a different group. You can not be a manager in two group' ;
				$_SESSION['alert'] = true;
				header("location: ./addAccGroup.html");
			
			} else {
				$query = "INSERT INTO `users_groups` (user_email, group_name, role) VALUES('$email', '$group', 'developer')";
				$result = $con->query($query);
				$_SESSION['message'] = ' You have successfully added ' . $email . ' as a developer to ' . $group;
				$_SESSION['alert'] = true;
				header("location: ./bootstrap-elements.html");
			}
		}

	} else {
		$_SESSION['message'] = ' Enter user email';
		$_SESSION['alert'] = true;
		header("location: ./addAccGroup.html"); //
	}


?>