<?php
    require("config.php");
	
	if($_SESSION['logged_in'] == true){
		//Construct query from email
		$userName = $_SESSION['username'];
		$res = $db->prepare("SELECT email FROM users WHERE username = :user");
		$res->bindParam(":user", $userName);
		if($res->execute()) {
			$assoc = $res->fetchAll(PDO::FETCH_ASSOC);
			if(sizeof($assoc) > 0) {
				//Echo results
				echo "<h3>" .$userName. " | Member</h3>";
				echo "<p>Email: " .$assoc[0]['email']. " </br>";
			} else {
				echo "<h3> Error fetching data for profile. Session: ".$_SESSION['user']."</h3>";
                                echo "<pre>"; 
                                var_dump($_SESSION); 
                                echo "</pre>";
			}
		}
	} else {
		header("Location: ../index.html");
	}
    
?>