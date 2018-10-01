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
	<link rel="stylesheet" type="text/css" href="css/test.css">
	<!--JavaScript/AJAX-->
	<script src="theater.js"></script>
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
				<li><a href="#details">DETAILS</a></li>
        <li><a href="#showtimes">SHOWTIMES</a></li>
        <li><a href="index.php#locations">LOCATIONS</a></li>
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
	<form class="form-inline">
    <div class="input-group">
      <input type="text" class="form-control" size="25" placeholder="ZIP" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger">Search</button>
      </div>
    </div>
  </form>
</div>
<body>
<div id="signup-container" class="container-fluid text-center bg-black">
	<div class="row text-center">
		<div class='col-sm-3'>
		</div>
		<div class='col-sm-5'>
	<?php
		if ( isset($_SESSION["user"]) ) {
			echo "<h3>You are already signed in. Cannot create account.</h3>";
			//redirect to account page
		}
		else {
			echo "<form class='signup' action='accountProcess.php' method='POST' onsubmit='return validateForm()'>";
			echo "<fieldset>";
			echo "<legend>Create Account</legend>";
			//standard account info
			echo "<input type='text' name='email' id='email' placeholder='enter email' onblur='showConflict(this.value)' required/><br/>";
			echo "<input type='text' name='username' id='username' placeholder='username' onblur='showConflict(this.value)' required/>";
			echo "<span id='conflict'></span></br>";
			echo "<label>FIRST</label>";
      echo "<input type='text' name='firstName' id='first-name' placeholder='' required/>";
			echo "<input type='text' name='midName' id='mid-name' placeholder='middle name or initial'>";
      echo "<input type='text' name='lastName' id='last-name' placeholder='last name' required/><br/>";
			echo "<input type='text' name='addrStreet' id='street-address' placeholder='street address'/><br/>";
			echo "<input type='text' name='addrCity' id='city' placeholder='city'/>";
			echo "<input type='text' name='addrState' id='state' placeholder='state'/>";
			echo "<input type='text' name='addrZip' id='zip' placeholder='zip'/><br>";
			echo "<input type='date' name='DOB' id='DOB' placeholder='birthdate mm/dd/yyyy' max='2004-06-01'/><br/>";
      echo "<input type='password' name='password' id='password' placeholder='password' onkeyup='checkPasswordMatch()' required/>";
      echo "<input type='password' name='passConfirm' id='passConfirm' placeholder='confirm password' onkeyup='checkPasswordMatch()' required/>";
			echo "<span id='matchAlert' class='glyphicon glyphicon-unchecked'></span></br>";
			//credit card
			//checkbox to hide show form
			
			echo "<input type='checkbox' name='termsAgree' value='Yes' required> I agree to the site <a href='images/noGood.png' target='_blank'>terms and conditions</a>.<br>";
			echo "<input type='submit' id='submit' disabled='true' value='Submit'>";
			echo "</fieldset>";
			echo "</form>";
		}
	?>
		</div>
	</div>
</div>
</body>
</html>