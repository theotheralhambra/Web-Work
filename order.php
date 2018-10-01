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


<!-- SQL "SELECT password FROM Customer WHERE username = $user_var" -->
<nav href="#header" class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">BC</a>
			<a href="index.php"><img class="navbar-logo" src="images/ticket.PNG" alt="Ticket"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">HOME</a></li>
				<li><a href="#order">ORDER</a></li>
        <!--li><a href="#showtimes">SHOWTIMES</a></li-->
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
						//echo "<span id='login-field' onload='loginHandler('load')></span>";
						
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

<div id="order" class="container-fluid text-center bg-dark">
	<!--h2 class="text-center">COMING SOON</h2>
	<h3>For now, please purchase tickets when you arrive.</h3-->
	<!--?php echo $_GET["time"] ?-->
	<?php
	if ( !isset($_SESSION["username"]) ) {
			echo "<h3>You are not signed in. Please create an account to buy tickets: <a href='signup.php'>SIGN UP</a></h3>";
			//redirect to account page
		}
		else {
			echo "<div class='col-sm-3'>";
			echo "</div>";
			echo "<div class='col-sm-6'>";
			
			echo "<form class='signup' action='orderProcess.php' method='POST'>";
			echo "<fieldset>";
			//standard account info
			echo "<div class='row'>";
			echo "<div class='col-sm-2'>";
			echo "<input type='text' name='user' value='" . $_SESSION["username"] . "' hidden='true'>";
			echo "<input type='text' name='film' value='" . $_GET["film"] . "' hidden='true'>";
			echo "<input type='text' name='theatre' value='" . $_GET["theatre"] . "' hidden='true'>";
			echo "<input type='text' name='time' value='" . $_GET["time"] . "' hidden='true'>";
			echo "<input type='text' name='format' value='" . $_GET["format"] . "' hidden='true'>";
			echo "</div>";
		
			echo "<div class='col-sm-2'>";
			echo "<label> ADULT</label><br>";
			echo "<input type='number' name='adult' min='0' max='10' value='0'>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<label> CHILD</label><br>";
			echo "<input type='number' name='child' min='0' max='10' value='0'>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<label> STUDENT</label><br>";
			echo "<input type='number' name='student' min='0' max='10' value='0'>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<label> SENIOR</label><br>";
			echo "<input type='number' name='senior' min='0' max='10' value='0'>";
			echo "</div>";
			echo "</div>";
		
		
			echo "<br><br><div class='col-sm-5'>";
			echo "</div>";
		
			echo "<input type='submit' id='submit' disabled='true' value='Place Order'>";
			echo "</fieldset>";
			echo "<br><br><div class='col-sm-2'>";
			echo "</div>";
			echo "<p>The credit card associated with your account will be billed.</p>";
			echo "</form>";
			echo "</div>";
			
		}
	?>
</div>

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