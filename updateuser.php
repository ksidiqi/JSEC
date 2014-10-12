<?php  //Start the Session
ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();
	$handle = @fopen("./user.txt", "r");
	$username = "mustafa";
	if ($handle) {
		while (($buffer = fgets($handle, 4096)) !== false) {
			$username = $buffer;
		}
		if (!feof($handle)) {
			echo "Error: unexpected fgets() fail\n";
		}
		fclose($handle);
	}
	libxml_use_internal_errors(true);
	$doc = new DOMDocument();
	$doc->loadHTMLFile("/var/www/html/dashboard/index.html");
	$doc->getElementById('user-name')->nodeValue =  $username;
	$doc->getElementById('login-date')->nodeValue = date("F j, Y, g:i a");   
	$doc->saveHTMLFile("/var/www/html/dashboard/index.html");
	libxml_use_internal_errors(false);
	header( 'Location: ./dashboard/index.html' );
?>