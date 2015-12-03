/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script


<?php
    //require("config.php");
    session_start();
	
	if (isset($_SESSION)) {
		if($_SESSION['logged_in'] == true){
			if ($_SESSION['chat_type'] != "group") {
				header("Location:../individualchat.html");
			} else {
				header("Location: ../groupchat.html");
			}
			if ($_SESSION['chat_ready'] = true) {
				header("Location: ../login.html");
			}
			//register unsuccessful
			if($_SESSION['registered'] == false) {
				header("Location: ../profile.html");
			} else {
				// if user is already logged, redirect to landing page
				header("Location: ../landing.html");
			}
		} else {
			if($_SESSION['registered' == false]) {
				header("Location: ../registerfail.html");
			} else {
				// if user is not logged in, redirect to login page
				header("Location: ../login.html");
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