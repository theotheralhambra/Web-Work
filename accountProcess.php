<?php
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
	$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$connect) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//user acct stuff
		$email = clean_input($_POST['email']);
		$username = clean_input($_POST['username']);	
		$firstName = clean_input($_POST['firstName']);
		$midName = clean_input($_POST['midName']);
		$lastName = clean_input($_POST['lastName']);
		$addrStreet = clean_input($_POST['addrStreet']);
		$addrCity = clean_input($_POST['addrCity']);
		$addrState = clean_input($_POST['addrState']);
		$addrZip = clean_input($_POST['addrZip']);
		$DOB = $_POST['DOB'];
		$password = sha1(clean_input($_POST['password']));
		//credit card stuff
		$ccNumber = clean_input($_POST['ccNumber']);
		$ccCompany = clean_input($_POST['ccCompany']);
		$ccExpire = clean_input($_POST['ccExpire']);
		$ccCID = clean_input($_POST['ccCID']);
		$billingZip = clean_input($_POST['billingZip']);
		$name = clean_input($_POST['ccName']);
		
		//$_SESSION["username"] = $_POST['username'];
		if($_GET["u"] == true){
			$sql = "UPDATE Customer SET password='$password', email='$email', firstName='$firstName', midName='$midName', lastName='$lastName', addrStreet='$addrStreet', addrCity='$addrCity', addrState='$addrState', addrZip='$addrZip', DOB='$DOB' WHERE username='$username'";
			if (mysqli_query($connect, $sql)) {
				//echo "<p onload='return redirectHome()'>Record inserted successfully into database 'Customers'<p>";
			} else {
				//echo "<p onload='return redirect('signup.php')'>Error updating record: " . mysqli_error($dbc) . "</p>";
			}
			$sql = "UPDATE CreditCard (ccNumber='$ccNumber', ccCompany='$ccCompany', ccExpire='$ccExpire', ccCID='$ccCID', billingZip='$billingZip', name='$name' WHERE username='$username'";
			if (mysqli_query($connect, $sql)) {
				//echo "<p onload='return redirectHome()'>Record inserted successfully into database 'Customers'<p>";
			} else {
				//echo "<p onload='return redirect('signup.php')'>Error updating record: " . mysqli_error($dbc) . "</p>";
			}
		} else {
			//insert into Customer db
			$sql = "INSERT INTO Customer (username, password, email, firstName, midName, lastName, addrStreet, addrCity, addrState, addrZip, DOB) VALUES ('$username', '$password', '$email', '$firstName', '$midName', '$lastName', '$addrStreet', '$addrCity', '$addrState', '$addrZip', '$DOB')";
			if (mysqli_query($connect, $sql)) {
				//echo "<p onload='return redirectHome()'>Record inserted successfully into database 'Customers'<p>";
				$_SESSION['username'] = $_POST['username'];
			} else {
				//echo "<p onload='return redirect('signup.php')'>Error updating record: " . mysqli_error($dbc) . "</p>";
			}
			$sql = "INSERT INTO CreditCard (ccNumber, ccCompany, ccExpire, ccCID, billingZip, name, username) VALUES ('$ccNumber', '$ccCompany', '$ccExpire', '$ccCID', '$billingZip', '$name', '$username')";
			if (mysqli_query($connect, $sql)) {
				//echo "<p onload='return redirectHome()'>Record inserted successfully into database 'Customers'<p>";
			} else {
				//echo "<p onload='return redirect('signup.php')'>Error updating record: " . mysqli_error($dbc) . "</p>";
			}
		}
	}
	//mysqli_free_result($result);
	mysqli_close($connect);
	?>
	</body>
</html>