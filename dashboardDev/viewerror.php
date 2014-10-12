<?php
	session_start(); 
	include('./connect.php');
	if(isset($_POST['error_id'])){		
		$error_id =addslashes($_POST['error_id']);
		$result = $con->query("SELECT * FROM errors WHERE id= '$error_id'");
		if($error = $result->fetch_array(MYSQLI_ASSOC)){
			$_SESSION['error_id'] = $error['id'];
			header( 'Location: ./forms2.html' ) ;
		} else {
			echo "not found";
		}
	}
?>