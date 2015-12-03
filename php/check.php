<?php
/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/
    //require("config.php");
    session_start();
	
	if (isset($_SESSION)) {
		if($_SESSION['logged_in'] == true){
			if ($_SESSION['role'] == "individual") {
				header("Location:../individualchat.html");
			}
			if ($_SESSION['chat_ready'] = true) {
				//header("Location: ../login.html");
			}
			//register unsuccessful
			if($_SESSION['registered'] == false) {
				header("Location: ../profile.html");
			} else {
				// if user is already logged, redirect to landing page
				header("Location: ../landing.html");
			}
		} else {
			if($_SESSION['registered'] == true) {
				// if user is not logged in, redirect to login page
				header("Location: ../login.html");
			} else {
				header("Location: ../registerfail.html");
			}
		}
	} else {
		if($_SESSION['registered'] == true) {
			header("Location: ../landing.html");
		} else {
			header("Location: ../index.html");
		}
	}
?>