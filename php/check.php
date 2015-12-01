<?php
    require("config.php");
	
	if($_SESSION['logged_in'] == true){
		
	} else {
		header("Location: ../index.html");
	}
    
?>