<?php
	//start the session
	session_start();
	
	$username = $_POST["username"];
	$_SESSION["username"] = $username;

	//hash password

	//retrieve paswword from DB
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$query = "SELECT password FROM Customer WHERE username = '$username'";

	$result = mysqli_query($conn, $query);
	$row = $result->fetch_assoc();	

	if (!$result) {
		die("Query to show fields from table failed");
	}
	//the the number or row in the result
	$fields_num = mysqli_num_rows($result);
	
	//check if a result was returned
	if ($fields_num == 0){
		//if not there are no users with that name
		//alert invalid username
	}
	//compare passwords
	else if ($_POST["password"] == $row["password"]){
		//do login stuff
		//the links need to change to onclick actions to invoke this script
		echo "<li><a href='account.php'>ACCOUNT</a></li>" . "<li><a href='logout.php'>LOG OUT</a></li>";
	}
	//invalid login or action is logout
	else {
		//kill session
		//alert 
	}	

	// Output "no suggestion" if no hint was found or output correct values 
	echo $user === "" ? "no suggestion" : "That username is taken. Please try another";//$user;
?>
