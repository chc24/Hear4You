<?php
	include('login.php');
	if(isset($_SESSION['user'])) {
		header("location: profile.php");
	}
?>
