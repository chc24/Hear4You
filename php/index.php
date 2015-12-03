<?php
	//include('login.php');
	if(isset($_SESSION['username'])) {
		header("Location: profile.php");
	}
?>
