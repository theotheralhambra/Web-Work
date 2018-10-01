<!DOCTYPE html>
<html lang="en">
<head>
  <title>Beaver Cinemas</title>
  <meta charset="utf-8">
	<!--bootstrap-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--fonts-->
	<link href='//fonts.googleapis.com/css?family=Atomic Age' rel='stylesheet'>
	<link href='//fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
	<link href='//fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>
	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--JavaScript/AJAX-->
	<script src="theater.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" onload="return redirectHome()">
<?php
	//start the session
	session_start();
	
	//$_SESSION["username"] = $_POST["username"];

	//retrieve paswword from DB
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$query = "SELECT password FROM Customer WHERE username='" . $_POST["username"] . "'";//'$username'";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$row = $result->fetch_assoc();	
	
	//check if a result was returned
	/*if ($fields_num == 0){
		// remove all session variables
		session_unset(); 
		// destroy the session 
		session_destroy();
		//alert //session var to alert in dropdown??
	}*/
	//compare passwords
	if (sha1($_POST["password"]) == $row["password"]){
		//do login stuff
		$_SESSION["username"] = $_POST["username"];//$username;
	}
	//invalid login or action is logout
	else {
		// remove all session variables
		session_unset(); 
		// destroy the session 
		session_destroy();
	}
?>
</body>
</html>