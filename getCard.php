<?php
	//retrieve usernames from DB
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	$query = "SELECT ccNumber FROM CreditCard WHERE 1 ORDER BY ccNumber ASC";

	$result = mysqli_query($conn, $query);

	if (!$result) {
		die("Query to show fields from table failed");
	}
	//the the number or row in the result
	$fields_num = mysqli_num_rows($result);
	
	//write the results to an array for later comparison
	while($row = $result->fetch_assoc()) {
		$a[] = (string)$row["ccNumber"];
	}	
	
	// get the q parameter from URL
	$q = $_REQUEST["q"];
	
	$card = "";

	// lookup all hints from array if $q is different from "" 
	if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $cc) {
			if ($q === $cc){
				//
				$card = $cc;
			}	
				/*
        if (stristr($q, substr($name, 0, $len))) {
            if ($user === "") {
                $user = $name;
            } else {
                $user .= ", $name";
            }
        }
				*/
    }
	}
	// Output "no suggestion" if no hint was found or output correct values 
	echo $card === "" ? "" : "Card already in system. Please try another";//$user;
?>