<?php  //Start the Session
session_start();
//connecting to database
include('./connect.php');
	


if (isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['password1']) and isset($_POST['password2'])){

	$first = addslashes($_POST['first_name']);
	$last = addslashes($_POST['last_name']);
	$email = addslashes($_POST['email']);
	$password1 = addslashes($_POST['password1']);
	$password2 = addslashes($_POST['password2']);
	$priv = addslashes($_POST['privilege']);

	$result = $con->query("SELECT * FROM `users` WHERE email='$email'");
	$count = $result->num_rows;
	
	if (strcmp($_SESSION['account_role'], 'manager') != 0 ) {
		$_SESSION['message'] = ' Only manager and admin can add account';
		$_SESSION['alert'] = true;
		header("location: ./bootstrap-elements.html"); //	
	}
	else if (strcmp($password1, $password2) != 0) {
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