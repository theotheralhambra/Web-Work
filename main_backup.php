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
      <a class="navbar-brand" href="#top">BC</a>
			<a href="#top"><img class="navbar-logo" src="images/ticket.PNG" alt="Ticket"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="#movies">MOVIES</a></li>
        <li><a href="#services">SERVICES</a></li>
        <li><a href="#locations">LOCATIONS</a></li>
        <li><a href="#about">ABOUT</a></li>
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
						echo "<form name='login' action='login.php' method='post' onsubmit='return validateLogin()'>";
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

<div id="header" class="jumbotron text-center">
  </br></br>
	<h1 class="corp">BEAVER CINEMAS</h1> 
	<p class="sub">Bringing Hollywood home to the Willamette Valley since 2017</p> 
	<form class="form-inline">
    <div class="input-group">
      <input type="text" class="form-control" size="25" placeholder="ZIP" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger">Search</button>
      </div>
    </div>
  </form>
</div>

<!-- This will be featured movies and pull from DB -->
<!-- SQL "SELECT picURL, title, MPAA FROM Film" -->
<div id="movies" class="container-fluid text-center bg-light">
  <h2>FEATURED MOVIES</h2>
  <h4>NOW PLAYING AT A THEATER NEAR YOU!</h4>
		<div class="row text-center">
			<?php
				//retrieve film info from database
				include 'connectvars.php'; 
	
				$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if (!$conn) {
					die('Could not connect: ' . mysql_error());
				}
				$query = "SELECT picURL, title, MPAA,	releaseDate, director, filmFormat, runtime, filmID FROM Film WHERE 1";

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
					echo "<a class='pop-text' href='movie.php?filmID=" . $row["filmID"] . "'>Check Showtimes</a>";
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

<div id="services" class="container-fluid text-center bg-dark">
  <h2 class="no-breaks">THE <span class="inline-brand-big">BEAVER CINEMAS</span> ADVANTAGE</h2>
  <h4>CUTTING EDGE TECHNOLOGY, INDUSTRY LEADING CUSTOMER SERVICE</h4>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-film logo-small"></span>
      <h4>POWER</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-sound-dolby logo-small"></span>
      <h4>IMMERSIVE AUDIO</h4>
      <p>All theaters feature Dolby Digital 7.1 &reg surround sound to take you out of your seat and into the movie.</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-cutlery logo-small"></span> <!-- glyphicon-glass discuss bar service -->
      <h4>DINING</h4>																					<!-- -music -star -star-empty -off -headphones -volume-up -phone -tree-conifer -sunglasses (3d) -->
      <p>At <span class="inline-brand-big">Beaver Cinemas</span>, your snack options don't stop at popcorn. All Cinemas feature an expanded snack menu and select locations feature a full-service dining experience while you watch the movie.</p>												<!-- -hd-video -sound-dolby -sound-7-1 -cutlery -eye-open -play -facetime-video -->
    </div>
    </div>
    <br><br>
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-glass logo-small"></span>
      <h4>INDULGE</h4>
      <p>Select Cinemas are equipped with a full service bar featuring hand-crafted cocktails and a rotating selection of craft-brewed beers and local wines for our guests 21+</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-headphones logo-small"></span>
      <h4>ACCESSIBLE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-home logo-small"></span>
      <h4>LOCAL</h4>
      <p>At <span class="inline-brand-big">Beaver Cinemas</span> we are proud...</p>
    </div>
  </div>
</div>

<!-- This will be a list of our theatres and pull from DB -->
<!-- SQL "SELECT picURL, addrNeighbor, scrnCnt, theatreType, addrStreet, addrCity, addrState, addrZip, phone FROM Theatre" -->
<?php
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$query = "SELECT picURL, addrNeighbor, scrnCnt, theatreType, addrStreet, addrCity, addrState, addrZip, phone FROM Theatre";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	$fields_num = mysqli_num_fields($result);
	//echo "<h1>User List: </h1>";
	echo "<div id='locations' class='container-fluid text-center bg-light'>";
	echo "<h2><span class='inline-brand-big'>Beaver Cinemas</span> Locations</h2>";
	echo "<h4>Your neighbourhood entertainment destination</h4>";
	echo "<div class='row text-center'>";
	
	while($row = $result->fetch_assoc()) {
      echo "<div class='col-sm-4'>";
			echo "<div class='thumbnail'>";
			
			//pic and name have link to theatre pages
			echo "<a href='#locations'><img src='images/" . $row["picURL"] . "' alt='img'></a>";
			echo "<a href='#locations'><h4><strong>". $row["addrNeighbor"]. " Cinema " . $row["scrnCnt"] . "</strong></h4></a>";
			echo "<p>" . $row["addrStreet"] . "</p>";
			echo "<p>" . $row["addrCity"] . ", " . $row["addrState"] . " " . $row["addrZip"] . "</p>";
			echo "<p>" . $row["phone"] . "</p></br>";
			
			echo "</div>";
			echo "</div>";
  }
	echo "</div>";
	echo "</div>";
	
	mysqli_free_result($result);
	mysqli_close($conn);
?>
<!-- old theatre list, no DB req -->
<!--div id="locations" class="container-fluid text-center bg-light">
  <h2><span class="inline-brand-big">Beaver Cinemas</span> Locations</h2>
  <h4>Your neighbourhood entertainment destination</h4>
  <div class="row text-center">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/paris.jpg" alt="Paris">
        <p><strong>Paris</strong></p>
        <p>Yes, we built Paris</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/newyork.jpg" alt="New York">
        <p><strong>New York</strong></p>
        <p>We built New York</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="images/sanfran.jpg" alt="San Francisco">
        <p><strong>San Francisco</strong></p>
        <p>Yes, San Fran is ours</p>
      </div>
    </div>
	</div>
</div-->

<!-- Feature positive feedback. Could also be adapted for featured movies. -->
<!-- SQL "SELECT review, username FROM Review WHERE score >= 4"-->
<div class="container-fluid text-center bg-dark">
	<h2>What our customers say</h2>
	<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
			<h4>"This company is the best. I am so happy with the result!"<br><span style="font-style:normal;">Michael Roe, Vice President, Comment Box</span></h4>
			</div>
			<div class="item">
				<h4>"One word... WOW!!"<br><span style="font-style:normal;">John Doe, Salesman, Rep Inc</span></h4>
			</div>
			<div class="item">
				<h4>"Could I... BE any more happy with this company?"<br><span style="font-style:normal;">Chandler Bing, Actor, FriendsAlot</span></h4>
			</div>
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


<div id="about" class="container-fluid bg-light">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Company Page</h2>
      <h4>Lorem ipsum..</h4> 
      <p>Lorem ipsum..</p>
      <button class="btn btn-default btn-lg">Get in Touch</button>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<div id="" class="container-fluid bg-dark">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo"></span> 
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2>
      <h4><strong>MISSION:</strong> Our mission lorem ipsum..</h4> 
      <p><strong>VISION:</strong> Our vision Lorem ipsum..</p>
    </div>
  </div>
</div>

<div id="contact" class="container-fluid bg-light">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Corvallis, OR</p>
      <p><span class="glyphicon glyphicon-phone"></span> (541) 555-5555</p>
      <p><span class="glyphicon glyphicon-envelope"></span> customer.service@beavermovies.com</p> 
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
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div> 
    </div>
  </div>
</div>


</body>
</html>
