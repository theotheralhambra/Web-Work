<?php
	// Start the session
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
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
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<!--JavaScript/AJAX & jQuery-->
	<script src="theater.js"></script>
	<script>
		$(document).ready(function(){
			// Add smooth scrolling to all links in navbar + footer link
			$(".navbar a, footer a[href='#myPage']").on('click', function(event) {
				// Make sure this.hash has a value before overriding default behavior
				if (this.hash !== "") {
					// Prevent default anchor click behavior
					event.preventDefault();
					// Store hash
					var hash = this.hash;
					// Using jQuery's animate() method to add smooth page scroll
					// The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
					$('html, body').animate({
						scrollTop: $(hash).offset().top
					}, 900, function(){
						// Add hash (#) to URL when done scrolling (default click behavior)
						window.location.hash = hash;
					});
				} // End if
			});
		})
	</script>
	
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">


<!-- SQL "SELECT password FROM Customer WHERE username = $user_var" -->
<nav href="#header" class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">BC</a>
			<a href="#"><img class="navbar-logo" src="../images/ticket.PNG" alt="Ticket"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="../index.php">HOME</a></li>
				<!-- login element will need php to check for logged in log yes -> logout and account buttons; log no -> login button -->
				<!-- login via dropdown fields??? -->
				<?php
					if ( isset($_SESSION["username"]) ) {
						//echo "<span id='login-field' onload='loginHandler('continue')></span>";
						
						//show account link
						echo "<li><a href='account.php'>ACCOUNT</a></li>";
						//show log out link
						echo "<li><a href='logout.php'>LOG OUT</a></li>";
					}
					else {
						//echo "<span id='login-field' onload='loginHandler('load')></span>";
						
						echo "<li class='dropdown'>";
						echo "<a href='javascript:void(0)' class='dropbtn' >LOGIN</a>";
						echo "<div class='dropdown-content'>";
						//echo "<form name='login' action='login.php' method='POST' onsubmit='return validateLogin()'>";
						echo "<form name='login' method='POST' onsubmit='loginHandler()'>";
						echo "<input type='text' class='login-field' size='40' name='username' id='user' placeholder='username' required></br>"; //onblur='loginHandler(this.value)'
						echo "<input type='password' class='login-field' size='40' name='password' placeholder='password' id='pass' onblur='' required></br>"; //onblur='loginHandler(document.getElementById('user').value, this.value)'
						echo "<button type='submit' onclick='loginHandler()' class=''>Login</button></br> <!--type='button'-->";
						echo "</form>";
						echo "<span id='login-error'></span></br>";
						echo "<a href='signup.php' class='recover-link'>New User?</a></br>";
						echo "<a href='#' class='recover-link'>Forgot Password/Username?</a>";
						echo "</div>";
						echo "</li>";
						
					}
				?>
      </ul>
    </div>
  </div>
</nav>

<div id="header" class="jumbotron text-center">
  </br></br>
	<h1 class="corp">BEAVER CINEMAS</h1> 
	<p class="sub">Bringing Hollywood home to the Willamette Valley since 2017</p> 
	<!--form class="form-inline">
    <div class="input-group">
      <input type="text" class="form-control" size="25" placeholder="ZIP" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger">Search</button>
      </div>
    </div>
  </form-->
</div>
	
<ul>
	<li> <a href="afterLogin.php">Home</a></li>
</ul>

	<!-- Establish connection. -->
	<?php
		# Establish a connectiont with the database. 
		$servername = "classmysql.engr.oregonstate.edu";
		$username = "cs340_garcibru";
		$password = 1318;
		$databaseName = "cs340_garcibru";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $databaseName);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
	?>

	<form action="updated.php" method="POST" style="width: 500px; margin: 50px auto 0 auto;">
  		Enter theaterID:
  		<input type="text" name="theatreID"><br>
  		Enter film ID:
  		<input type="text" name="filmID"><br>
  		<input type="submit" value="Submit">
	</form> 

<!-- --> 
	<?php 
		$_SESSION['adminOption'] = $_POST['adminOption'];
		echo $_SESSION['adminOption'];

		echo "Current movies: <br>";
		// Get the data using SQL.
		$sql = "SELECT showtime, Theatre.addrStreet, Film.title, Showtime.theatreID, Film.filmID
				FROM Showtime, Theatre, Film
				WHERE Showtime.filmID = Film.filmID AND Showtime.theatreID = Theatre.theatreID";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        echo "Showtime: " . $row['showtime']. " | Address: " . $row['addrStreet']. " | Title: " .$row['title']. " | theatreID: " .$row['theatreID']. " | filmID: " ,$row['filmID'], "<br>";
		    }
		} else {
		    echo "0 results";
		}
	?>

	<!-- Close connection. -->
	<?php
		// Close connection.
		 mysqli_close($conn); 
	?>
	
</body>
</html> 


