<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<div class="topnav" id="myTopnav">
	<a href="index.php" class="active">Sign-Up</a>
	<a href="list.php">List Users</a>
	<a href="#contact">Contact</a>
	<a href="#about">About</a>
</div>
<body>
	<!--?php
		$currentPage = "Signup";
		include 'nav.php';
	?-->
    <form name="myForm" action="accountProcess.php" method="POST" onsubmit="return validateForm()"> 
	<fieldset>
	  <legend>New User Registration</legend>
      <label>First Name</label>
        <input type="text" name="first" class="standard" required/>
      <label>Last Name</label> 
        <input type="text" name="last" class="standard" required/><br/>
      <label>Email</label><br/> 
        <input type="text" name="email" class="wide" placeholder="xxxxxxx@xmail.xxx" required/><br/>
      <label>Username</label>
        <input type="text" name="username" class="standard" required/><br/>
      <label>Password</label> 
        <input type="password" name="pass" class="standard" required/>
			<label>Confirm Password</label> 
        <input type="password" name="passConfirm" class="standard" required/><br/>
      <label>Age</label>
				<select name="age" >
							<option disabled selected value> </option>
					<?php
						for ($i=1; $i<=120; $i++)
						{
					?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php
						}
					?>
				</select>
			<br><br>	
			<input type="submit" value="Submit">
			<input type="reset">
	</fieldset>
	</form>
	<hr/>
	<?php include 'footer.php'; ?>
</body>
</html>