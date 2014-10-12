<?php  //Start the Session
session_start();
//connecting to database
include('./connect.php');
	
	if (strcmp($_SESSION['account_role'], 'manager') != 0 ) {
		$_SESSION['message'] = ' Only manager and admin can add account';
		$_SESSION['alert'] = true;
		header("location: ./bootstrap-elements.html"); //	
	} 
	else if (isset($_POST['password1']) and isset($_POST['password2'])){
		//$email = $_POST['email'];
		$password1 = addslashes($_POST['password1']);
		$password2 = addslashes($_POST['password2']);
		
		$id = $_SESSION['edituser_id'];	
		$preemail = $_SESSION['edituser_email'];
		//for future uses 
		if(strcmp($password1, $password2) == 0){
			$result = $con->query("UPDATE users SET email='$email', password='$password1' WHERE id='$id'");
			//$result2 = $con->query("UPDATE users_groups SET user_email='$email',  WHERE user_email='$preemail'");
			//$result3 = $con->query("UPDATE comments SET user_email='$email' WHERE user_email='$preemail'");
			$_SESSION['message'] = ' successfully edit.';
			$_SESSION['alert'] = true;
			header("location: ./edituser.html"); //
		}
		else {
			$_SESSION['message'] = ' Passwords do not match.';
			$_SESSION['alert'] = true;
			header("location: ./edituser.html"); 
		}
	}

?>