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
if (isset($_POST['group_name'])){
	$name = $_POST['group_name'];
	
	$query = "DELETE FROM groups WHERE name='$name'"; //detel from group
	$result1 = $con->query($query) or die ('Could not connect to the database server' . $con->error );
	
	//$query = "DELETE FROM comments_groups WHERE group_id='$name'";
	//$result = $con->query($query) or die ('Could not connect to the database server' . $con->error );
	
	
	if ($con->affected_rows > 0){
		$query = "DELETE FROM users_groups WHERE group_name='$name'"; //delete the roles users has 
		$result2 = $con->query($query) or die ('Could not connect to the database server' . $con->error );
		
		$query = "DELETE FROM comments WHERE group_name='$name'"; //delte all comments associated to the group
		$result3 = $con->query($query) or die ('Could not connect to the database server' . $con->error );

		$query = "DELETE FROM errors WHERE group_name='$name'"; //delete all the errors associated with the group
		$result = $con->query($query) or die ('Could not connect to the database server' . $con->error );	
	

		$_SESSION['message'] = ' You successfully deleted a group. ';
		$_SESSION['alert'] = true;
		header("location: ./bootstrap-elements.html"); //
	}else{
		$_SESSION['message'] = ' could not delete group. It does not exist ';
		$_SESSION['alert'] = true;
		header("location: ./deletegroup.html"); //
	}
}
$con->close();
?>