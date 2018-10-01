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

<!--NAVBAR-->
<!-- SQL "SELECT password FROM Customer WHERE username = $user_var" -->
<nav href="#header" class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php#locations">BC</a>
			<a href="index.php#locations"><img class="navbar-logo" src="images/ticket.PNG" alt="Ticket"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">HOME</a></li>
				<li><a href="#details">DETAILS</a></li>
				<li><a href="#concessions">CONCESSIONS</a></li>
				<li><a href="#movies">MOVIES</a></li>
        <li><a href="#reviews">REVIEWS</a></li>
        <li><a href="#contact">CONTACT</a></li>
				<!-- login element will need php to check for logged in log yes -> logout and account buttons; log no -> login button -->
				<!-- login via dropdown fields??? -->
				<?php
					if ( isset($_SESSION["username"]) ) {
						//show account link
						echo "<li><a href='account.php'>ACCOUNT</a></li>";
						//show log out link
						echo "<li><a href='logout.php'>LOG OUT</a></li>";
					}
					else {
						echo "<li class='dropdown'>";
						echo "<a href='javascript:void(0)' class='dropbtn'>LOGIN</a>";
						echo "<div class='dropdown-content'>";
						echo "<form name='login' method='POST' action='login.php'>";
						echo "<input type='text' class='login-field' size='40' name='username' placeholder='username' required></br>";
						echo "<input type='password' class='login-field' size='40' name='password' placeholder='password' required></br>";
						echo "<button type='submit' class=''>Login</button></br> <!--type='button'-->";
						echo "</form>";
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
<!--JUMBOTRON-->
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

<!--THEATRE INFO-->
<!-- SQL "SELECT picURL, title, MPAA FROM Film" -->
<div id="details" class="container-fluid text-center bg-light">
	<h2><span class="inline-brand-big">THEATRE INFO</span></h2>
  <?php
		//get filmID from url via GET method
		if ( isset($_GET['theatreID']) ) {
				$theatreID = $_GET['theatreID'];
				//DEBUG echo "<h1>Film ID = " . $filmID . "</h1>";
		} else {
				echo "<h1>Theatre ID not found</h1>";
				//die
		}
		//retrieve indicated film info from database
		include 'connectvars.php'; 
	
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}
		$query = "SELECT theatreID, theatreType, addrStreet, addrCity, addrState, addrZip, addrNeighbor, phone, picURL, scrnCnt, info FROM Theatre WHERE theatreID=" . $theatreID;

		$result = mysqli_query($conn, $query);
		if (!$result) {
			echo "<h1>bad query</h1>";
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
			echo "<div class='thumbnail-info-short'>"; //thumbnail-left
			//read and format running time and release date
			$thisPhone = $row["phone"];
			$thisName = $row["addrNeighbor"]. " Cinema " . $row["scrnCnt"];
			$thisType = $row["theatreType"];
			echo "<div class='info-header-short'>";
			echo "<h3><strong>". $thisName . "</strong></h3>";
			echo "<p class='info-stats'>" . $row["addrStreet"] . "  "  . $row["addrCity"] . ", " . $row["addrState"] . " " . $row["addrZip"] . "</p>";
			echo "<p class='info-stats'>" . $row["phone"] . "</p></br>";
			echo "</div>";
			echo "<p class='info'>" . $row["info"] . "</p>";
			
			echo "</div>";
			echo "</div>";
			
		}
	?>
</div>

<!--CONCESSIONS-->
<div id="concessions" class="container-fluid text-center bg-dark">
	<h2 class="no-breaks"><span class="inline-brand orange">CONCESSIONS</span></h2>
	<h4>FROM SWEET TREATS TO HOT EATS, AT <span class="inline-brand">BEAVER CINEMAS</span> WE'VE GOT WHAT YOU CRAVE</h4>
	<br>
  <div class="row">
		<?php
			echo "<div class='col-sm-12'>";
      
			//retrieve indicated film info from database
			include 'connectvars.php'; 
	
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}
			$query = "SELECT name, category, price FROM Concession WHERE 1 ORDER BY category, name";
				
			$result = mysqli_query($conn, $query);
			if (!$result) {
				echo "<h1>bad query</h1>";
				die("Query to show fields from table failed");
			}
		
			$fields_num = mysqli_num_fields($result);
			switch ($thisType){
				case "deluxe":
				echo "<h3 class='orange'>SANDWICHES (served with fries)</h3>";
					for ($c = 7; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>PIZZA</h3>";
					for ($c = 3; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>PIZZA TOPPINGS</h3>";
					for ($c = 7; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>PASTA</h3>";
					for ($c = 4; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>BAR</h3>";
					for ($c = 5; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>POPCORN</h3>";
					for ($c = 4; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>CANDY</h3>";
					for ($c = 14; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>SNACKS</h3>";
					for ($c = 3; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>ICE CREAM</h3>";
					for ($c = 4; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					break;
				case "plus":
					for ($c = 21; $c > 0; $c--) {
						$row = $result->fetch_assoc();
					}
					echo "<h3 class='orange'>BAR</h3>";
					for ($c = 5; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>POPCORN</h3>";
					for ($c = 4; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>CANDY</h3>";
					for ($c = 14; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>SNACKS</h3>";
					for ($c = 3; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>ICE CREAM</h3>";
					for ($c = 4; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					break;
				case "standard":
					for ($c = 26; $c > 0; $c--) {
						$row = $result->fetch_assoc();
					}
					echo "<h3 class='orange'>POPCORN</h3>";
					for ($c = 4; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>CANDY</h3>";
					for ($c = 14; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>SNACKS</h3>";
					for ($c = 3; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					echo "<h3 class='orange'>ICE CREAM</h3>";
					for ($c = 4; $c > 0; $c--) {
						$row = $result->fetch_assoc();
						echo $row["name"] . "......" .  $row["price"] . "<br>";
					}
					break;
				default:
					break;
			}
			/*	
			} else if ($thisType == "plus"){
				$query = "SELECT name, category, price FROM Concession WHERE theatreType = 'standard' OR theatreType = 'plus' ORDER BY CATEGORY";
			} else {
				$query = "SELECT name, category, price FROM Concession WHERE 1 ORDER BY CATEGORY";
			}
			/*
			$result = mysqli_query($conn, $query);
			if (!$result) {
				echo "<h1>bad query</h1>";
				die("Query to show fields from table failed");
			}
		
			$fields_num = mysqli_num_fields($result);
		
			while($row = $result->fetch_assoc()) {
			
				echo $row["name"] . "   " .  $row["price"] . "<br>";
				
			
				//<h4>POWER</h4>
				//<p>Lorem ipsum dolor sit amet..</p>
			}
			*/
			echo "</div>";
		?>
	</div>
  <br><br>
</div>

<!-- This will be featured movies and pull from DB -->
<!-- SQL "SELECT picURL, title, MPAA FROM Film" -->
<div id="movies" class="container-fluid text-center bg-light">
  <h2><span class="inline-brand-big">FEATURED MOVIES</span></h2>
  <h4>NOW PLAYING AT YOUR <?php echo strtoupper($thisName) ?></h4>
		<div class="row text-center">
			<?php
				//retrieve film info from database
				include 'connectvars.php'; 
	
				$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if (!$conn) {
					die('Could not connect: ' . mysql_error());
				}
				//$query = "SELECT picURL, title, MPAA,	releaseDate, director, filmFormat, runtime, filmID FROM Film WHERE 1";
				$query = "SELECT picURL, title, MPAA, releaseDate, director, filmFormat, runtime, filmID FROM Film WHERE filmID IN (SELECT DISTINCT filmID FROM Showtime WHERE theatreID=" . $_GET["theatreID"] . ") ORDER BY releaseDate DESC"; //" ORDER BY title DESC)";
				$result = mysqli_query($conn, $query);
				if (!$result) {
					//echo "<h1>fml</h1>";
					die("Query to show fields from table failed");
				}
		
				$fields_num = mysqli_num_fields($result);
		
				while($row = $result->fetch_assoc()) {
					echo "<div class='col-sm-4'>";
					echo "<div class='thumbnail covered'>";
					//show poster
					echo "<img class='image' src='images/" . $row["picURL"] . "' alt='img'>";
					//show link on hover
					echo "<div class='middle'>";
					echo "<a class='pop-text' href='movie.php?filmID=" . $row["filmID"] . "&theatreID=" . $_GET["theatreID"] . "'>Check Showtimes</a>";
					echo "</div>";
					
					//show details
					echo "<h4 class='film-title-small'>" . $row["title"] . "</h4>";
					//read and format running time and release date
					$time = date_create($row["runtime"]);
					$time_h = date_format($time, "h");
					$time_m = date_format($time, "i");
					$date = date_create($row["releaseDate"]);
					$date_f = date_format($date, "M d");
					echo "<p>" . $row["MPAA"] . " | Released " . $date_f . " | " . $time_h . " HR " . $time_m . " MIN" . "</p></br>";
					/*
					$count = 1;
					switch ($row["filmFormat"]) {
						case "imax":
							//IMAX
							$count += 1;
						case "3d":
							if ($count > 0) {
								echo "<span>   |   </span>";
							}
							//sprite glasses
							echo "<span class='glyphicon glyphicon-sunglasses logo-xtra-small'></span>";
							$count += 1;
						case "digi":
							if ($count > 0) {
								echo "<span> " . " | " . " </span>";
							}
							//sprite dolby
							echo "<span class='glyphicon glyphicon-sound-dolby format'></span>";
							$count += 1;
							break;
						default:
							//sprite dolby
							break;
					}
					*/
					echo "</div>";
					echo "</div>";
				}
			?>
		</div>
</div>

<!-- Feature positive feedback. Could also be adapted for featured movies. -->
<!-- SQL "SELECT review, username FROM Review WHERE score >= 4"-->
<div id="reviews" class="container-fluid text-center bg-dark">
	<h2>What our customers say</h2><br>
	<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
		<!-- Indicators -->
		<!--ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol-->

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<?php
				include 'connectvars.php'; 
	
				$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if (!$conn) {
					die('Could not connect: ' . mysql_error());
				}
				$query = "SELECT username, score, review FROM Review WHERE theatreID =" . $_GET['theatreID'];

				$result = mysqli_query($conn, $query);
				if (!$result) {
					die("Query to show fields from table failed");
				}
	
				$fields_num = mysqli_num_rows($result);
				echo "<ol class='carousel-indicators'>";
				for ($count=1; $count <= $fields_num; $count++){
					echo "<li data-target='#myCarousel' data-slide-to='" . $count . "'></li>";
				}
				echo "</ol>";
				$count = 1;
				while($row = $result->fetch_assoc()){
					if ($count == 1){
						echo "<div class='item active'>";
						$count = 2;
					} else {
						echo "<div class='item'>";
					}
					for ($i = 0; $i < $row["score"]; $i++){
						echo "<span class='glyphicon glyphicon-star logo-small'></span>";
					}
					for ($i = 0; $i < 5 - $row["score"]; $i++){
						echo "<span class='glyphicon glyphicon-star-empty logo-small'></span>";
					}
					echo "<h4>" . $row["review"] . "<br><span style='font-style:normal;'>" . $row["username"] . "</span></h4>";
					echo "</div>";
				}
			?>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

<div id="contact" class="container-fluid bg-light">
	<?php
		if (isset($_SESSION["username"])){
			echo "<h2 class='text-center'>LEAVE A REVIEW</h2>";
			echo "<div class='row'>";
			echo "<div class='col-sm-5'>";
      echo "<p>Contact us and we'll get back to you within 24 hours.</p>";
      echo "<p><span class='glyphicon glyphicon-map-marker'></span> Corvallis, OR</p>";
      echo "<p><span class='glyphicon glyphicon-phone'></span><?php echo $thisPhone ?></p>";
      echo "<p><span class='glyphicon glyphicon-envelope'></span> customer.service@beavermovies.com</p>"; 
			//<!--employee login link-->
			//<!--p><span class="glyphicon glyphicon-envelope"></span> customer.service@beavermovies.com</p--> 
			echo "<p>DISCLAIMER: This site was created by Rick Menzel and Bruce Garcia for CS340 at Oregon State University, Spring Term 2017. Certain elements exist on this site which are purely aethetic and non-functional. Furthermore, the underlying database will likely be deleted after June 2017. If you find yourself here after that, good luck. All images used are either assumed to be in the public domain or considered to be fair use as the inclusion on this page can be construed as free promotion and therefore acting accordance with the commercial best interests of the copyright owners.</p>"; 
			echo "</div>";
			echo "<div class='col-sm-7'>";
			echo "<form action='review.php' method='POST'>";
      echo "<div class='row'>";
      echo "<div class='col-sm-6 form-group' hidden='true'>";
      echo "<input class='form-control' name='username' value='" . $_SESSION["username"] . "' type='text' hidden='true' required>";
      echo "</div>";
			echo "<div class='col-sm-6 form-group' hidden='true'>";
      echo "<input class='form-control' name='theatreID' value='" . $_GET["theatreID"] . "' type='text' hidden='true' required>";
      echo "</div>";
      echo "<div class='col-sm-6 form-group'>";
      //echo "<input class='form-control' id='email' name='email' placeholder='Email' type='email' required>";
			echo "<label> Rating </label><br>";
			echo "<input type='radio' name='score' value='1'> 1 ";
			echo "<input type='radio' name='score' value='2'> 2 ";
			echo "<input type='radio' name='score' value='3' checked> 3 ";
			echo "<input type='radio' name='score' value='4'> 4 ";
			echo "<input type='radio' name='score' value='5'> 5 ";
			echo "<br>";
      echo "</div>";
      echo "</div>";
      echo "<textarea class='form-control' id='comments' name='review' placeholder='Comments' rows='5'></textarea><br>";
      echo "<div class='row'>";
      echo "<div class='col-sm-12 form-group'>";
      echo "<button class='btn btn-default pull-right' type='submit'>Send</button>";
      echo "</div>";
      echo "</div>"; 
			echo "</form>";
			echo "</div>";
			echo "</div>";
		} else {
			echo "<h2 class='text-center'>CONTACT</h2>";
			echo "<div class='row'>";
			echo "<div class='col-sm-5'>";
      echo "<p>Contact us and we'll get back to you within 24 hours.</p>";
      echo "<p><span class='glyphicon glyphicon-map-marker'></span> Corvallis, OR</p>";
      echo "<p><span class='glyphicon glyphicon-phone'></span><?php echo $thisPhone ?></p>";
      echo "<p><span class='glyphicon glyphicon-envelope'></span> customer.service@beavermovies.com</p>"; 
			//<!--employee login link-->
			//<!--p><span class="glyphicon glyphicon-envelope"></span> customer.service@beavermovies.com</p--> 
			echo "<p>DISCLAIMER: This site was created by Rick Menzel and Bruce Garcia for CS340 at Oregon State University, Spring Term 2017. Certain elements exist on this site which are purely aethetic and non-functional. Furthermore, the underlying database will likely be deleted after June 2017. If you find yourself here after that, good luck. All images used are either assumed to be in the public domain or considered to be fair use as the inclusion on this page can be construed as free promotion and therefore acting accordance with the commercial best interests of the copyright owners.</p>";
			echo "</div>";
			echo "<div class='col-sm-7'>";
			echo "<form>";
      echo "<div class='row'>";
      echo "<div class='col-sm-6 form-group'>";
      echo "<input class='form-control' id='name' name='name' placeholder='Name' type='text' required>";
      echo "</div>";
      echo "<div class='col-sm-6 form-group'>";
      echo "<input class='form-control' id='email' name='email' placeholder='Email' type='email' required>";
      echo "</div>";
      echo "</div>";
      echo "<textarea class='form-control' id='comments' name='comments' placeholder='Comments' rows='5'></textarea><br>";
      echo "<div class='row'>";
      echo "<div class='col-sm-12 form-group'>";
      echo "<button class='btn btn-default pull-right' type='submit' onclick='clearForm()'>Send</button>";
      echo "</div>";
      echo "</div>";
			echo "</form>";
			echo "</div>";
			echo "</div>";
		}
	?>
</div>


</body>
</html>
