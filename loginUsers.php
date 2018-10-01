<?php
	// Start the session
	//session_start();

	//retrieve usernames from DB
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$u = $_REQUEST["u"];
	$query = "SELECT username, password FROM Customer WHERE username = 'u'";//$_POST['user']";

	$result = mysqli_query($conn, $query);
	$row = $result->fetch_assoc();
	
	if (!$result) {
		die("Query to show fields from table failed");
	}
	//the the number or row in the result
	$fields_num = mysqli_num_rows($result);
	
	//check if a result was returned
	if ($fields_num == 0){												//no user by that name
		// remove all session variables
		//session_unset(); 
		// destroy the session 
		//session_destroy();
		//no user by that name
		echo "User Not Found";
	}					//sha1()
	else if ($_REQUEST["p"] == $row["password"]){	//valid login
		//good login -> do login stuff
		$_SESSION['username'] = $_POST['user'];
		echo "good";
	}
	else {																				//incorrect password 
		// remove all session variables
		//session_unset(); 
		// destroy the session 
		//session_destroy();
		//incorrect password 
		echo "Invalid Password";
	}
	//echo $user === "" ? "no suggestion" : "That username is taken. Please try another";//$user;
?>