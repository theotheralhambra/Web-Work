<!DOCTYPE html>
<!-- showTable.php -->
<html>
<head>
	<title>List Users</title>
	<link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<div class="topnav" id="myTopnav">
	<a href="index.php">Sign-Up</a>
	<a href="list.php" class="active">List Users</a>
	<a href="#contact">Contact</a>
	<a href="#about">About</a>
</div>
<body>

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
	echo "<h1>User List: {$table}</h1>";
	echo "<table border='1'><tr>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++) {	
		$field = mysqli_fetch_field($result);	
		echo "<th><b>{$field->name}</b></th>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {	
		echo "<tr>";	
		
		foreach($row as $cell)		
			echo "<td>$cell</td>";	
		echo "</tr>\n";
	}

	mysqli_free_result($result);
	mysqli_close($conn);
	?>
</body>

</html>