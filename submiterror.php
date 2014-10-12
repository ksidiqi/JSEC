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



if (isset($_POST['error']) AND isset($_POST['url']) AND isset($_POST['line']) AND isset($_POST['email']) AND isset($_POST['group'])){

	$errormsg = $_POST['error'];
	$url = $_POST['url'];
	$line = $_POST['line'];
	$email = $_POST['email'];	
	$group = $_POST['group'];
	
	date_default_timezone_set('America/Los_Angeles');
	$exist = $con->query("SELECT * FROM errors WHERE url = '$url' AND line = '$line'");
	$numb_rows = $exist->num_rows;

	if( $numb_rows < 1 ){
		$query = "INSERT INTO errors  (user_email, group_name, reason, url, line, date, count) VALUES('$email', '$group', '$errormsg', '$url', '$line', NOW(), '1' )";
		$con->query($query);
	} else {
		$error = $exist->fetch_array(MYSQLI_ASSOC);
		$id = $error['id'];	
		$con->query("UPDATE errors SET count = (count + 1), reason= '$errormsg' WHERE id='$id' ");
	}	
}


?>