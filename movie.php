<?php
// Start the session
session_start();
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
	<!--JavaScript/AJAX & jQuery-->
	<script src="theater.js"></script>
	<script>
		function showTimes(date) {
			if (date === 1){
				//generate the date for onload action
				var full = new Date();
				var y = full.getFullYear();
				y = y.toString();
				var m = full.getMonth() + 1;
				m = m.toString();
				var d = full.getDate();
				d = d.toString();
				date = y + "-0" + m + "-" + d;
			}
			//deselect current day
			var elems = document.getElementsByClassName("curr-day");
			elems[0].className = "col-sm-1";
			//set new current day
			document.getElementById(date).className = "col-sm-1 curr-day";
			//hide currently displayed showtimes
			var elems = document.getElementsByClassName("time");

			for(var i = 0; i != elems.length; ++i){
				elems[i].hidden = true;
			}
			//reveal new showtimes
			var elems = document.getElementsByClassName(date);

			for(var i = 0; i != elems.length; ++i){
				elems[i].hidden = false;
			}
			//document.getElementsByClassName("purchase").hidden = false;
			//alert(date);
			return 0;
		}
	</script>
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
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" onload="showTimes(1)">


<!-- SQL "SELECT password FROM Customer WHERE username = $user_var" -->
<nav href="#header" class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php#movies">BC</a>
			<a href="index.php#movies"><img class="navbar-logo" src="images/ticket.PNG" alt="Ticket"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">HOME</a></li>
				<li><a href="#details">DETAILS</a></li>
        <li><a href="#showtimes">SHOWTIMES</a></li>
        <!--li><a href="#reviews">REVIEWS</a></li-->
        <li><a href="#contact">CONTACT</a></li>
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
						echo "<li class='dropdown'>";
						echo "<a href='javascript:void(0)' class='dropbtn' >LOGIN</a>";
						echo "<div class='dropdown-content'>";
						//echo "<form name='login' action='login.php' method='POST' onsubmit='return validateLogin()'>";
						echo "<form name='login' method='POST' action='login.php'>";
						echo "<input type='text' class='login-field' size='40' name='username' id='user' placeholder='username' required></br>"; //onblur='loginHandler(this.value)'
						echo "<input type='password' class='login-field' size='40' name='password' placeholder='password' id='pass' required></br>"; //onblur='loginHandler(document.getElementById('user').value, this.value)'
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

<!-- SQL "SELECT picURL, title, MPAA FROM Film" -->
<div id="details" class="container-fluid text-center bg-light" onload="getTimes()">
	<h2><span class="inline-brand-big">MOVIE INFO</span></h2>
  <?php
		//get filmID from url via GET method
		if ( isset($_GET['filmID']) ) {
				$filmID = $_GET['filmID'];
				//DEBUG echo "<h1>Film ID = " . $filmID . "</h1>";
		} else {
				echo "<h1>Film ID not found</h1>";
				//die
		}
		//retrieve indicated film info from database
		include 'connectvars.php'; 
	
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}
		$query = "SELECT picURL, title, MPAA,	releaseDate, director, distributor, genre, filmFormat, runtime, actor1,	actor2, actor3, info FROM Film WHERE filmID=" . $filmID;

		$result = mysqli_query($conn, $query);
		if (!$result) {
			echo "<h1>500</h1>";
			die("Query to show fields from table failed");
		}
		
		$fields_num = mysqli_num_fields($result);
		
		while($row = $result->fetch_assoc()) {
			//display poster
			echo "<div class='col-sm-4'>";
			echo "<div class='thumbnail'>"; //thumbnail-left
			//display poster
			echo "<img src='images/" . $row["picURL"] . "' alt='img'>";
			echo "</div>";
			echo "</div>";
			
			//display movie details
			echo "<div class='col-sm-8'>";
			echo "<div class='thumbnail-info'>"; //thumbnail-left
			//read and format running time and release date
			$time = date_create($row["runtime"]);
			$time_h = date_format($time, "h");
			$time_m = date_format($time, "i");
			$date = date_create($row["releaseDate"]);
			$date_f = date_format($date, "M d");
			echo "<div class='info-header'>";
			echo "<h3><strong>" . $row["title"] . "</strong> (" . $row["MPAA"] . ") | " . $time_h . " HR " . $time_m . " MIN" . "</strong></h3>";
			echo "<p class='info-stats'>" . "Released " . $date_f . " | " . $row["genre"] . " | " . $row["distributor"] . " | Director: " . $row["director"] . "</p>";
			echo "</div>";
			echo "<p class='info'>" . $row["info"] . "</p>";
			
			echo "</div>";
			echo "</div>";
			
		}
	?>
</div>

<!--dark light dark for 3 theaters-->
<!-- SQL "SELECT picURL, title, MPAA FROM Film" -->
<div id="showtimes" class="container-fluid text-center bg-dark"> <!--?php echo "onload=\"showTimes('" . date('Y-m-d') . "')\"" ?>> <!--onload="getShowtimes('2017-06-15')"-->
	<h2><span class="inline-brand-big">SHOWTIMES</span></h2>
		<!--?php echo "<h3>" . date("Y-m-d G:i") . "</h3>" ?-->
		<div class="row center-row">
			<!--div class='col-sm-.5'></div-->
				<?php
					for($i = 0; $i < 11; $i++){
						//echo "<a class='date-tile' onclick='getTimes(" . $_GET["filmID"] . ", " . $_GET["theatreID"] . ", " . date('Y-m-d', strtotime($i . ' days')) . ")'>";
						echo "<a class='date-tile' onclick=\"showTimes('" . date('Y-m-d', strtotime($i . ' days')) . "')\">";
						if ($i == 0) {
							echo "<div class='col-sm-1 curr-day' id='" . date('Y-m-d', strtotime($i . ' days')) . "'>";//
						} else {
							echo "<div class='col-sm-1' id='" . date('Y-m-d', strtotime($i . ' days')) . "'>";//
						}
						//echo "<div class='col-sm-1'>";// id='" . date("Y-m-d", strtotime($i . " days")) . "'>";
						//if logged in
						echo "<h3>" . date("D", strtotime($i . " days")) . "</h3>";
						echo "<h2>" . date("d", strtotime($i . " days")) . "</h2>";
						echo "<h3 class='sub-month'>" . date("M", strtotime($i . " days")) . "</h3>";
						//else
						//echo link to signup.php?ref=1
						echo "</div>";
						echo "</a>";
					}
				?>
		</div>
		<span id="time-list"></span>
		<?php
			include 'connectvars.php';
	
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if(!$conn){
				die('Could not connect: ' . mysqli_error());
			}
			//DEBUG echo "<h1>theatre ID=" . $_GET['theatreID'] . "</h1>";
			if( isset($_GET['theatreID']) ){
				//DEBUG echo "<h1>THEATRE SET</h1>";
				//$query = "SELECT showtime, filmFormat FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=" . $_GET["theatreID"] . " ORDER by showtime, filmFormat";
				$query1 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=" . $_GET["theatreID"] . " AND filmFormat='imax' ORDER by showtime";
				$query2 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=" . $_GET["theatreID"] . " AND filmFormat='3d' ORDER by showtime";
				$query3 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=" . $_GET["theatreID"] . " AND filmFormat='digi' ORDER by showtime";
			
				//$result = mysqli_query($conn, $query);
				$result1 = mysqli_query($conn, $query1);
				$result2 = mysqli_query($conn, $query2);
				$result3 = mysqli_query($conn, $query3);
				$fields_num1 = mysqli_num_rows($result1);
				$fields_num2 = mysqli_num_rows($result2);
				$fields_num3 = mysqli_num_rows($result3);
		
				if ($fields_num1 > 0) {
					echo "<h3>IMAX</h3>";
					while($row = $result1->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=imax&theatre=" . $_GET["theatreID"] . "&film=" . $_GET["filmID"] . "' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num2 > 0) {
					echo "<h3>3D</h3>";
					while($row = $result2->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=3d&theatre=" . $_GET["theatreID"] . "&film=" . $_GET["filmID"] . "' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num3 > 0) {
					echo "<h3>DIGITAL</h3>";
					while($row = $result3->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=digi&theatre=" . $_GET["theatreID"] . "&film=" . $_GET["filmID"] . "' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
			} else if ( isset($_GET["filmID"]) ){
				//DEBUG echo "<h1>THEATRE NOT SET</h1>";
				//$query = "SELECT showtime, theatreID, filmFormat FROM Showtime WHERE filmID=" . $_GET["filmID"] . " ORDER BY theatreID, filmFormat, showtime";
				$query1 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=1 AND filmFormat='imax' ORDER BY theatreID, showtime";
				$query2 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=1 AND filmFormat='3d' ORDER BY theatreID, showtime";
				$query3 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=1 AND filmFormat='digi' ORDER BY theatreID, showtime";
				
				//$result = mysqli_query($conn, $query);
				$result1 = mysqli_query($conn, $query1);
				$result2 = mysqli_query($conn, $query2);
				$result3 = mysqli_query($conn, $query3);
				$fields_num1 = mysqli_num_rows($result1);
				$fields_num2 = mysqli_num_rows($result2);
				$fields_num3 = mysqli_num_rows($result3);
		
				if ($fields_num1 > 0 || $fields_num2 > 0 || $fields_num3 > 0) {
					echo "<h2>CORVALLIS CINEMA 12</h2>";
				}
				if ($fields_num1 > 0) {
					echo "<h3>IMAX</h3>";
					while($row = $result1->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=imax&theatre=1' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num2 > 0) {
					echo "<h3>3D</h3>";
					while($row = $result2->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=3d&theatre=1' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num3 > 0) {
					echo "<h3>DIGITAL</h3>";
					while($row = $result3->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=digi&theatre=1&' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				
				//DEBUG echo "<h1>THEATRE NOT SET</h1>";
				//$query = "SELECT showtime, theatreID, filmFormat FROM Showtime WHERE filmID=" . $_GET["filmID"] . " ORDER BY theatreID, filmFormat, showtime";
				$query1 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=2 AND filmFormat='imax' ORDER BY theatreID, showtime";
				$query2 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=2 AND filmFormat='3d' ORDER BY theatreID, showtime";
				$query3 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=2 AND filmFormat='digi' ORDER BY theatreID, showtime";
				
				//$result = mysqli_query($conn, $query);
				$result1 = mysqli_query($conn, $query1);
				$result2 = mysqli_query($conn, $query2);
				$result3 = mysqli_query($conn, $query3);
				$fields_num1 = mysqli_num_rows($result1);
				$fields_num2 = mysqli_num_rows($result2);
				$fields_num3 = mysqli_num_rows($result3);
		
				if ($fields_num1 > 0 || $fields_num2 > 0 || $fields_num3 > 0) {
					echo "<h2>VALLEY RIVER CENTER CINEMA 12</h2>";
				}
				if ($fields_num1 > 0) {
					echo "<h3>IMAX</h3>";
					while($row = $result1->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=imax&theatre=2' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num2 > 0) {
					echo "<h3>3D</h3>";
					while($row = $result2->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=3d&theatre=2' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num3 > 0) {
					echo "<h3>DIGITAL</h3>";
					while($row = $result3->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=digi&theatre=2&' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				
				//DEBUG echo "<h1>THEATRE NOT SET</h1>";
				//$query = "SELECT showtime, theatreID, filmFormat FROM Showtime WHERE filmID=" . $_GET["filmID"] . " ORDER BY theatreID, filmFormat, showtime";
				$query1 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=3 AND filmFormat='imax' ORDER BY theatreID, showtime";
				$query2 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=3 AND filmFormat='3d' ORDER BY theatreID, showtime";
				$query3 = "SELECT showtime FROM Showtime WHERE filmID=" . $_GET["filmID"] . " AND theatreID=3 AND filmFormat='digi' ORDER BY theatreID, showtime";
				
				//$result = mysqli_query($conn, $query);
				$result1 = mysqli_query($conn, $query1);
				$result2 = mysqli_query($conn, $query2);
				$result3 = mysqli_query($conn, $query3);
				$fields_num1 = mysqli_num_rows($result1);
				$fields_num2 = mysqli_num_rows($result2);
				$fields_num3 = mysqli_num_rows($result3);
		
		
				if ($fields_num1 > 0 || $fields_num2 > 0 || $fields_num3 > 0) {
					echo "<h2>CORVALLIS CINEMA 4</h2>";
				}
				if ($fields_num1 > 0) {
					echo "<h3>IMAX</h3>";
					while($row = $result1->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=imax&theatre=3' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num2 > 0) {
					echo "<h3>3D</h3>";
					while($row = $result2->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=3d&theatre=3' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				if ($fields_num3 > 0) {
					echo "<h3>DIGITAL</h3>";
					while($row = $result3->fetch_assoc()){	//$row["filmFormat"]
						$time = date_create($row["showtime"]);
						//$showtime = date_format($time, "Y-m-d g:i");
						$targetDate = date_format($time, "Y-m-d");
						$showtime = date_format($time, "g:i");
						$linkDate = date_format($time, "Y-m-d g:i");
						echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=digi&theatre=3&' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
						echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
						echo "</a>";
					}
				}
				
			} else {
				echo "<h1>MOVIE NOT SET</h1>";
				echo "<h3>You shouldn't be here</h3>";
			}
			/*
			//$result = mysqli_query($conn, $query);
			$result1 = mysqli_query($conn, $query1);
			$result2 = mysqli_query($conn, $query2);
			$result3 = mysqli_query($conn, $query3);
			$fields_num1 = mysqli_num_rows($result1);
			$fields_num2 = mysqli_num_rows($result2);
			$fields_num3 = mysqli_num_rows($result3);
		
			if ($fields_num1 > 0) {
				echo "<h3>IMAX</h3>";
				while($row = $result1->fetch_assoc()){	//$row["filmFormat"]
					$time = date_create($row["showtime"]);
					//$showtime = date_format($time, "Y-m-d g:i");
					$targetDate = date_format($time, "Y-m-d");
					$showtime = date_format($time, "g:i");
					$linkDate = date_format($time, "Y-m-d g:i");
					echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=imax&theatre=1' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
					echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
					echo "</a>";
				}
			}
			if ($fields_num2 > 0) {
				echo "<h3>3D</h3>";
				while($row = $result2->fetch_assoc()){	//$row["filmFormat"]
					$time = date_create($row["showtime"]);
					//$showtime = date_format($time, "Y-m-d g:i");
					$targetDate = date_format($time, "Y-m-d");
					$showtime = date_format($time, "g:i");
					$linkDate = date_format($time, "Y-m-d g:i");
					echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=3d&theatre=1' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
					echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
					echo "</a>";
				}
			}
			if ($fields_num3 > 0) {
				echo "<h3>DIGITAL</h3>";
				while($row = $result3->fetch_assoc()){	//$row["filmFormat"]
					$time = date_create($row["showtime"]);
					//$showtime = date_format($time, "Y-m-d g:i");
					$targetDate = date_format($time, "Y-m-d");
					$showtime = date_format($time, "g:i");
					$linkDate = date_format($time, "Y-m-d g:i");
					echo isset($_SESSION["username"]) ? "<a href='order.php?time=" . $linkDate . "&?format=digi&theatre=1&' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
					echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . "</button>";
					echo "</a>";
				}
			}
			/*
			echo "<h3>3D</h3>";
			while($row = $result->fetch_assoc()){	//$row["filmFormat"]
				$time = date_create($row["showtime"]);
				//$showtime = date_format($time, "Y-m-d g:i");
				$targetDate = date_format($time, "Y-m-d");
				$showtime = date_format($time, "Y-m-d g:i");
				echo isset($_SESSION["username"]) ? "<a href='order.php?time=1&?format=1&theatre=1' class='time " . $targetDate . "' hidden='true'>" : "<a href='signup.php?ref=1' class='time " . $targetDate . "' hidden='true'>";
				echo "<button class='btn btn-default btn-lg dynamic-btn'>" . $showtime . " " . $row["filmFormat"] . "</button>";
				echo "</a>";
			}*/
			
		?>
		</span>
</div>

<!-- SELECT * FROM  WHERE filmID =  -->
<!-- using php OR SELECT * FROM   WHERE filmID= AND theatreID= -->
<!--div id="reviews" class="container-fluid text-center bg-light">
	<h2><span class="inline-brand-big">REVIEWS</span></h2>
</div-->

<div id="contact" class="container-fluid bg-light">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Corvallis, OR</p>
      <p><span class="glyphicon glyphicon-phone"></span> (541) 555-5555</p>
      <p><span class="glyphicon glyphicon-envelope"></span> customer.service@beavermovies.com</p>
			<!--employee login link-->
			<!--p><span class="glyphicon glyphicon-envelope"></span> customer.service@beavermovies.com</p--> 
			<p>DISCLAIMER: This site was created by Rick Menzel and Bruce Garcia for CS340 at Oregon State University, Spring Term 2017. Certain elements exist on this site which are purely aethetic and non-functional. Furthermore, the underlying database will likely be deleted after June 2017. If you find yourself here after that, good luck. All images used are either assumed to be in the public domain or considered to be fair use as the inclusion on this page can be construed as free promotion and therefore acting accordance with the commercial best interests of the copyright owners.</p> 
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit" onclick="clearForm()">Send</button>
        </div>
      </div> 
    </div>
  </div>
</div>

</body>
</html>
