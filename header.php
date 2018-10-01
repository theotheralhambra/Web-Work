<!DOCTYPE html>
<html>
<body>
	<?php
		$pgTitle = 'Rock/Paper/Scissors/Lizard/Spock';
		if ( isset($_SESSION["user"]) ) {
			$user = $_SESSION["user"];
		}
		else if ( isset($_GET['user']) ) {
			$user = $_GET['user'];
		}
		else {
			$user = 'User';
		}
		$content = array("Home"=>"index.html",
						 "Signup"=>"signup.php",
						 "Login"=>"login.php",
						 "My Account"=>"myAccount.php",
						 "Game"=>"rockPaperScissors.php",
						 "Rules"=>"rules.php",
						 "High Scores"=>"highScores.php",
						 "Logout"=>"logout.php");
		//$currentPage = "Game";
		echo '<ul>';
		echo '<li>' . $pgTitle . '</li>';
		foreach($content as $page => $location) {
			echo '<li>';
			echo "<a href='".$location."?user=".$user."'";
			echo ($page==$currentPage ? " class='active'" : "");
			echo " >".$page."</a>";
			//echo "<a href='".$location."?user=".$user."' ".($page==$currentPage? 'class="active":""');   //. (($page==$currentPage) ? '."class='active':''"').
			echo '</li>';
		}
		echo '<li>Welcome '.$user.'</li>';
		echo '</ul>';
	?>
</body>
</html>