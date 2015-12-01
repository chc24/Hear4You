<?php

session_start();

//Clears session cookie and overall session data
if(isset($_COOKIE[session_name])) {
	setcookie(session_name(), "", time() - 3600, "/");
}
unset($_SESSION);
session_destroy();
header("Location: ../index.html");

?>
