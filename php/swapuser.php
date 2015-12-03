<?php
	require("config.php");

	if($_SESSION['logged_in'] == true) {
		echo "<ul class='nav navbar-nav navbar-right'>
                    <li><a href='landing.html'><font color='#000000'>Chat Now</font></a></li>
                    <li><a href='resources.html'>Resources</a></li>
                    <li><a href='contact.html'>Contact</a></li>
                    <li><a href='profile.html'>".$_SESSION['username']."</a></li>
                    <li><a href='php/logout.php'>Sign Out</a></li>
                </ul>";
	} else {
		echo "<ul class='nav navbar-nav navbar-right'>
                    <li><a href='resources.html'>Resources</a></li>
                    <li><a href='contact.html'>Contact</a></li>
                    <li><a href='login.html'>Login</a></li>
                </ul>";
	}
?>