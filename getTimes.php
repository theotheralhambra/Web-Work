<?php
	// Start the session
	session_start();

	//retrieve usernames from DB
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$query = "SELECT showtime, filmFormat FROM Showtime WHERE filmID=" . $_GET["film"] . " AND theatreID=" . $_GET["theatre"] . " AND showtime LIKE  '" . $_GET["date"] . "%' ORDER by filmFormat, showtime";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		die("Query to show fields from table failed");
	}
	//the the number or row in the result
	$fields_num = mysqli_num_rows($result);
	//initialize empty string
	$str = "";
	//append search results to string
	while($row = $result->fetch_assoc()) {
		$time = date_create($row["showtime"]);
		$showtime = date_format($time, "g:i");
		isset($_SESSION["username"]) ? $str . "<a href='order.php?time=1&?format=1&theatre=1'>" : $str . "<a href='signup.php?ref=1'";
		$str . "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
		$str . "</a>";
	}	
	
	// Output string if not empty
	echo $str === "" ? "" : $str;
?>