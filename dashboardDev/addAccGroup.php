<?php  //Start the Session
session_start();
//connecting to database
include('./connect.php');
	


	if (isset($_POST['email'])){

		$email = addslashes($_POST['email']);
		$group = addslashes($_POST['group']);
		$role = addslashes($_POST['role']);

		$result = $con->query("SELECT * FROM `users` WHERE email='$email'");
		$count = $result->num_rows;		
		
		if (strcmp($_SESSION['account_role'], 'manager') != 0 ) {
			$_SESSION['message'] = ' Only manager and admin can add account to a group';
			$_SESSION['alert'] = true;
			header("location: ./addAccGroup.html"); //	
		}
		else if ($count == 0){
			$_SESSION['message'] = 'Account does not exist';
			$_SESSION['alert'] = true;
			header("location: ./addAccGroup.html"); //
		}		
		else if ($count == 1) {
			$query = "SELECT * FROM `users_groups` WHERE user_email='$email' AND (role='manager' or role='developer') ";
			$result = $con->query($query);
			if($result->num_rows > 0){
				$_SESSION['message'] = ' '.$email . ' is already a manager or developer in another group (a user can only be a manager or developer in only one group)';
				$_SESSION['alert'] = true;
				header("location: ./addAccGroup.html");
			} else {
				$query = "INSERT INTO `users_groups` (user_email, group_name, role) VALUES('$email', '$group', '$role')";
				$result = $con->query($query);
				$_SESSION['message'] = ' You have successfully added ' . $email . ' as ' . $role .  ' to ' . $group;
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