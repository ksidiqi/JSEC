<?php
	session_start(); 
	if(isset($_SESSION['error_id']) ){
		include('./connect.php');
		$error_id = $_SESSION['error_id'];
		$con->query("DELETE FROM errors WHERE id= '$error_id'");		
		$result3 = $con->query("SELECT comment_id FROM comments_errors where error_id = '$error_id' ");
		while($row = $result3->fetch_array()){
			//for each comment sum their severity 
			$con->query("DELETE FROM comments WHERE id='$row[0]'");			
		}
		$con->query("DELETE FROM comments_errors where error_id = '$error_id' ");
		$_SESSION['message'] = ' You succesfully delete an error';
		$_SESSION['alert'] = true;
		header("location: ./tables.html"); //	
		
	} else	{
		$_SESSION['message'] = ' Something went wrong you did not deleted an error';
		$_SESSION['alert'] = true;
		header("location: ./tables.html"); //		
	}
?>