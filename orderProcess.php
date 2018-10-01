<?php
//this page doesn't work at the moment


// Start the session
session_start();
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

	<?php
	// external login details
	include 'connectvars.php';
	//sanitize user input
	function clean_input($data){ 
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$adult = clean_input($_POST['adult']);
		$child = clean_input($_POST['child']);
		$student = clean_input($_POST['student']);
		$senior = clean_input($_POST['senior']);
		$user = clean_input($_POST['user']);
		$film = clean_input($_POST['film']);
		$theatre = clean_input($_POST['theatre']);
		$time = clean_input($_POST['time']);
		$format = clean_input($_POST['format']);
	
		//echo $time;
	
		$query = "SELECT reservations FROM Showtime WHERE showtime='" . $time . "' AND theatreID='" . $theatre . "' AND filmID='" . $film . "' AND filmFormat='" . $format . "'";
	
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}		
		$row = $result->fetch_assoc();	
		
		$numTix = $row["reservations"] + $adult + $child + $student + $senior;
		//echo $numTix;
		if ($numTix < 230){
			$sql = "UPDATE Showtime SET reservations='$numTix' WHERE showtime='" . $time . "' AND theatreID='" . $theatre . "' AND filmID='" . $film . "' and filmFormat='" . $filmFormat . "'";
			if (mysqli_query($connect, $sql)) {
				//echo "<p onload='return redirectHome()'>Record inserted successfully into database 'Customers'<p>";
			} else {
				//echo "<p onload='return redirect('signup.php')'>Error updating record: " . mysqli_error($dbc) . "</p>";
			}
		} else {
			echo "<p >Number of tickets requested exceeds availability.</p>";
		}
	}
	//mysqli_free_result($result);
	mysqli_close($connect);
	?>
	</body>
</html>