<?php
	session_start();
	include('./connect.php');
	
	if (strcmp($_SESSION['account_role'], 'manager') != 0 ) {
		$_SESSION['message'] = ' Only manager and admin can edit account';
		$_SESSION['alert'] = true;
		header("location: ./bootstrap-elements.html"); //	
	} else if (isset($_POST['email']) ){
		$email = addslashes($_POST['email']);
		$query = "SELECT * FROM `users` WHERE email='$email'";		 
		$result = $con->query($query);
		$count = $result->num_rows;	
		if ($count == 1){			
			$group = $_SESSION['account_group'];
			$query = "SELECT * FROM `users_groups` WHERE user_email='$email' AND group_name = '$group'";		 
			$result2 = $con->query($query);
			$count2 = $result2->num_rows;	
			if($count2 < 1){
				$_SESSION['message'] = ' You can not edit accounts that are not in your group.';
				$_SESSION['alert'] = true;
				header("location: ./edituser.html");			
			}else {			
				$row = mysqli_fetch_array($result);
				$_SESSION['edituser_id'] = $row['id'];
				$_SESSION['edituser_first'] = $row['first_name'];
				$_SESSION['edituser_last'] = $row['last_name'];
				$_SESSION['edituser_email'] = $row['email'];
				header("location: ./edituser2.html");
			}
		}else{
			$_SESSION['message'] = 'No such User exist, check the email and try again.';
			$_SESSION['alert'] = true;
			header("location: ./edituser.html");
		}
	}
	else {
		$_SESSION['message'] = 'Enter user email';
		$_SESSION['alert'] = true;
		header("location: ./edituser.html"); //
	}
?>