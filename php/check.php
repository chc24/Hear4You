<?php
/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/
    //require("config.php");
    session_start();
	
	if (isset($_SESSION)) {
		if($_SESSION['logged_in'] == true){
			// if (isset($_SESSION['roomID'])) {
			// 	header('Location: ../individualchat.php');
			// }

			if ($_SESSION['role'] == 'Speaker' || $_SESSION['role'] == 'Listener') {
				if ($_SESSION['chat_ready'] == true) {
					header("Location: find_match.php");
				}
			}
			
			// user is logged in but register is invalid
			if($_SESSION['registered'] == true) {
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