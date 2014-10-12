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
	

	if($_SESSION['username']) {
		
			if(strcmp($_SESSION['account_type'], 'admin') == 0){
				header( 'Location: ./../dashboard/index.html' );
			} else {
				header( 'Location: ./../dashboardDev/index.html' );
			}			
		}
	
	if (isset($_POST['email']) and isset($_POST['password'])){
		$username = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);
		$query = "SELECT * FROM `users` WHERE email='$username' and password='$password'";	 
		$result = $con->query($query);
		$count = $result->num_rows;
		if ($count == 1){
			date_default_timezone_set('America/Los_Angeles');
			$_SESSION['login'] = date('l jS \of F Y h:i:s A');			
			$_SESSION['username'] = $username;		
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$_SESSION['account_type'] = $row['type'];			
			$res = $con->query( "SELECT * FROM users_groups WHERE user_email='$username' AND role='manager' " );
			
			if($row2 = $res->fetch_array(MYSQLI_ASSOC)){
				$_SESSION['account_group'] = $row2['group_name'];
				$_SESSION['account_role'] = 'manager';
			} else {
				$_SESSION['account_group'] = NULL;
				$_SESSION['account_role'] = 'developer';
			}			
			$_SESSION['password'] = $password;	
			
			if(strcmp($_SESSION['account_type'], 'admin') == 0){
				header( 'Location: ./../dashboard/index.html' );
			} else {
				header( 'Location: ./../dashboardDev/index.html' );
			}	
	
			
		} else{
			$_SESSION['alert'] = true;
			$_SESSION['message'] = ' Invalid login, wrong password or email.';
			header( 'Location: ./index.html' );
		}
	} 

	else{
			$con->close();
			$_SESSION['alert'] = true;
			$_SESSION['message'] = ' Invalid login, wrong password or email.';
			header( 'Location: ./index.html' );
	}



?>