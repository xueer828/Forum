<?php 
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';

	$dbhandle = mysql_connect($dbhost, $dbuser, $dbpass) or die("Oops something went wrong you can try again in a few minutes.");  

	$dbname = 'webdb1236';
	mysql_select_db($dbname) or die("Oops something went wrong you can try again in a few minutes.");
?>