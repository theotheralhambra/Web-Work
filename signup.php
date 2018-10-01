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
      <a class="navbar-brand" href="#">BC</a>
			<a href="#"><img class="navbar-logo" src="images/ticket.PNG" alt="Ticket"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">HOME</a></li>
				<li><a href="#signup-container">SIGNUP</a></li>
        <li><a href="#contact">CONTACT</a></li>
				<!-- login element will need php to check for logged in log yes -> logout and account buttons; log no -> login button -->
				<!-- login via dropdown fields??? -->
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropbtn">LOGIN</a>
					<div class="dropdown-content">
						<input type="text" class="login-field" size="40" placeholder="username" required></br>
						<input type="password" class="login-field" size="40" placeholder="password" required></br>
						<button type="button" class="">Login</button></br>
						<a href="#" class="recover-link">New User?</a></br>
						<a href="#" class="recover-link">Forgot Password/Username?</a>
					</div>
				</li>	
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
<body>

<div id="signup-container" class="container-fluid text-center bg-black">
	<div class="row text-center">
		<div class='col-sm-3'>
		</div>
		<div class='col-sm-6'>
	<?php
		if ( isset($_SESSION["username"]) ) {
			echo "<h3>You are already signed in. Cannot create account.</h3>";
			//redirect to account page
		}
		else {
			echo "<form class='signup' action='accountProcess.php' method='POST' onsubmit='return validateForm()'>";
			echo "<fieldset>";
			if ( isset($_GET["ref"]) && $_GET["ref"] == 1 ){
				echo "<legend>You must create an account to buy tickets!</legend>";
			} else {
				echo "<legend>Create Account</legend>";
			}
			//standard account info
			echo "<input type='text' name='email' id='email' placeholder='enter email' required/><br/>";
			echo "<input type='text' name='username' id='username' placeholder='username' onblur='showConflict(this.value)' required/>";
			echo "<span id='conflict'></span></br>";
      echo "<input type='text' name='firstName' id='first-name' placeholder='first name' required/>";
			echo "<input type='text' name='midName' id='mid-name' placeholder='middle name or initial'>";
      echo "<input type='text' name='lastName' id='last-name' placeholder='last name' required/><br/>";
			echo "<input type='text' name='addrStreet' id='street-address' placeholder='street address'/><br/>";
			echo "<input type='text' name='addrCity' id='city' placeholder='city'/>";
			echo "<input type='text' name='addrState' id='state' placeholder='state'/>";
			echo "<input type='text' name='addrZip' id='zip' placeholder='zip'/><br>";
			echo "<input type='date' name='DOB' id='DOB' placeholder='birthdate mm/dd/yyyy' max='2004-06-01'/><br/>";
      echo "<input type='password' name='password' id='password' placeholder='password' onkeyup='checkPasswordMatch()' hidden='true' required/>";
      echo "<input type='password' name='passConfirm' id='passConfirm' placeholder='confirm password' onkeyup='checkPasswordMatch()' hidden='true' required/>";
			echo "<label id='matchAlertContain' hidden='true'><span id='matchAlert' class='glyphicon glyphicon-unchecked'></span></label></br>";
			echo "<hr>";
			//credit card
			//checkbox to hide show form
			//card num
			echo "<input type='text' name='ccNumber' id='' placeholder='0000000000000000' onblur='cardConflict(this.value)' required/>";
			echo "<span id='ccConflict'></span></br>";
			/*
			echo "<input type='text' name='cc04' id='' placeholder='0000' required/>";
			echo "<label>-</label>";
			echo "<input type='text' name='cc08' id='' placeholder='0000' required/>";
			echo "<label>-</label>";
			echo "<input type='text' name='cc12' id='' placeholder='0000' required/>";
			echo "<label>-</label>";
			echo "<input type='text' name='cc16' id='' placeholder='0000' required/>";
			*/
			echo "<br>";
			//company
			echo "<input type='radio' name='ccCompany' value='Visa'> VISA";
			echo "<input type='radio' name='ccCompany' value='MasterCard'> MasterCard";
			echo "<input type='radio' name='ccCompany' value='AmEx'> American Express";
			echo "<br>";
			//exp
			echo "<input type='date' name='ccExpire' min='2017-06-13'/><br/>";
			/*
			echo "<label>exp</label>";
			echo "<input type='text' name='dateM' id='' placeholder='00' required/>";
			echo "<label>/</label>";
			echo "<input type='text' name='dateY' id='' placeholder='00' required/>";
			*/
			//CCV/CID
			echo "<input type='text' name='ccCID' id='' placeholder='CID' required/>";
			echo "<br>";
			//Name on card
			echo "<input type='text' name='ccName' id='' placeholder='name on card' required/>";
			//zip
			echo "<input type='text' name='billingZip' id='' placeholder='ZIP' required/>";
			echo "<br>";
			echo "<hr>";
			echo "<input type='checkbox' name='termsAgree' value='Yes' required> I agree to the site <a href='images/noGood.png' target='_blank'>terms and conditions</a>.<br>";
			echo "<input type='submit' id='submit' disabled='true' value='Submit'>";
			echo "</fieldset>";
			echo "</form>";
		}
	?>
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