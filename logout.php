<?php
	// Start the session
	session_start();
	
	//echo "<h3>User " . $_SESSION["username"] . " has been logged out.";
	// remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy();
	//redirect to index.php?
	
?>
<?php
// Start the session
//session_start();
//$_SESSION['username'] = $_POST['username'];
?>
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
</body>
</html>