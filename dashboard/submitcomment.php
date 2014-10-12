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
	


if (isset($_POST['body']) ){

	$body = $_POST['body'];
	$severity = $_POST['severity'];
	$error_id = $_SESSION['error_id'];	

//	$result = $con->query("SELECT * FROM `errors` WHERE id='$error_id'");
//	$error = $result->fetch_array(MYSQLI_ASSOC)
//	$commentnumb = $error['number_of_comments'];
	$image=$_FILES['image']['tmp_name'];
    $fp = fopen($image, 'r');
    $content = fread($fp, filesize($image));
    $content = addslashes($content);
    fclose($fp);

	$email = $_SESSION['username'];
		
	$query = "INSERT INTO comments (user_email, body, severity, image) VALUES('$email','$body','$severity', '$content')";
	$result = $con->query($query);
	$comment_id = $con->insert_id;
	
	$query2 = "INSERT INTO `comments_errors` (comment_id, error_id) VALUES('$comment_id','$error_id')";
	$result2 = $con->query($query2);

	//updating severity 
	//get all comment for this error
	$query3 = "SELECT comment_id from comments_errors WHERE error_id = '$error_id' ";
	$result3 = $con->query($query3);
	$count = 0;
	$severity = 0;
	while($row = $result3->fetch_array()){
		//for each comment sum their severity 
		$result4 = $con->query("SELECT severity FROM comments WHERE id='$row[0]'");
		$comment = $result4->fetch_array(MYSQLI_ASSOC);
		$count++;
		$severity = $severity + $comment['severity'];
	}
	//take the average
	$severity = $severity / $count;	
	$query4 = "UPDATE errors SET severity = '$severity' WHERE id = '$error_id'";
	$result4 = $con->query($query4);

	header("location: ./forms2.html"); //	
	

}


?>