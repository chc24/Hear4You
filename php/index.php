<?php
	//include('login.php');
	if(isset($_SESSION['user'])) {
		header("Location: profile.php");
	}
?>
