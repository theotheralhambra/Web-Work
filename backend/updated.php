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

	<?php

	// Function that adds a new film to the database.
	function addFilm() {
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

		$sql = "INSERT INTO Film (filmID, title, picURL, MPAA, 
								  releaseDate, director, distributor, genre, 
								  filmFormat, runtime, actor1, actor2, 
								  actor3, info)
		VALUES ('" . $_POST['filmID'] . "', '". $_POST['title'] ."', '". $_POST['picURL'] ."', '". $_POST['MPAA'] ."'
		, '". $_POST['releaseDate'] ."', '". $_POST['director'] ."', '". $_POST['distributor'] ."', '". $_POST['genre'] ."'
		, '". $_POST['filmFormat'] ."', '". $_POST['runtime'] ."', '". $_POST['actor1'] ."', '". $_POST['actor2'] ."'
		, '". $_POST['actor3'] ."', '". $_POST['info'] ."')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		// Close connection. 
		mysqli_close($conn);
	}

	// Funtion that deletes a film from the database.
	function deleteFilm() {
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

		// Save film name in the session array. 
		$_SESSION['filmName'] = $_POST['filmName'];
		echo "You inserted: " . $_SESSION['filmName'] . "<br>";
		$filmToDelete = $_SESSION['filmName'];

		// sql to delete a record
		$sql = "DELETE FROM Film WHERE title = '" . $filmToDelete . "';";

		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully <br>";
		} else {
		    echo "Error deleting record: " . $conn->error . "<br>";
		}

		// Get the data using SQL.
		$sql = "SELECT title, MPAA FROM Film";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        echo "MPAA: " . $row['MPAA']. " - title: " . $row['title']. "<br>";
		    }
		} else {
		    echo "0 results";
		}	

		// Close connection. 
		mysqli_close($conn);
	}

	function addShowtime() {
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

		$sql = "INSERT INTO Auditorium (screenNum, theatreID, seatCap, filmFormat)
			VALUES (".$_POST['screenNum'].",". $_POST['theaterID']. ", ".$_POST['seatCap'].", '".$_POST['filmFormat']."')";
    
		if ($conn->query($sql) === true) {
		    echo "new record created successfully<br>";
		} else {
		    echo "Auditorium: error: " . $sql . "<br>" . $conn->error . "<br>";
		}

		$sql = "INSERT INTO Showtime (screenNum, theatreID, filmID, filmFormat)
		VALUES (' ".$_POST['screenNum']." ', ' ".$_POST['theaterID']." ' , ' ".$_POST['filmID']." ', ' ".$_POST['filmFormat']." ')";

		if ($conn->query($sql) === true) {
		    echo "new record created successfully<br>";
		} else {
		    echo "Showtime: error: " . $sql . "<br>" . $conn->error . "<br>";
		}
		// Close connection. 
		mysqli_close($conn);
	}

	function deleteShowtime() {
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

		$sql = "DELETE FROM Showtime WHERE theatreID = " .$_POST['theatreID']. " AND filmID = ".$_POST['filmID']." ";
    
		if ($conn->query($sql) === true) {
		    echo "new record created successfully<br>";
		} else {
		    echo "Auditorium: error: " . $sql . "<br>" . $conn->error . "<br>";
		}

		// Close connection. 
		mysqli_close($conn);

	}
	


		$userChoice = $_SESSION['adminOption'];
		echo $userChoice . "<br>";

		switch ($userChoice) {
			case 'addFilm':
				addFilm();
				break;
			case 'deleteFilm':
				deleteFilm();
				break;
			case 'addShowtime':
				addShowtime();
				break;
			case 'deleteShowtime':
				deleteShowtime();
				break;
			default:
				echo "Error";
				break;
		}

	?>


	<form action="afterLogin.php">
	    <input type="submit" value="Go to Homepage" />
	</form>

</body>
</html> 
