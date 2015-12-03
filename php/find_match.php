<?php
/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/

require("config.php");
//require("check.php");

session_start();

$role = $_SESSION['role'];
if ($role != "group") {
	$query = "
		SELECT username, AVG(score) as score_avg
		FROM (SELECT o.username, u.id
			  FROM online o, users u
			  WHERE o.role == :role AND o.username == u.username) AS online_usernames,
			 rating r
		WHERE online_usernames.id == r.recip_id
		GROUP BY online_usernames.id";

	$stmt = $db->prepare($query);
	$result->bindParam(":role", findOppositeRole($role));

	if($result->execute()) {
		echo "successful query";
		$assoc = $result->fetchAll(PDO::FETCH_ASSOC);
		$counter = sizeof($assoc);
		while($counter >= 0) {
			$counter=$counter-1;
			echo "<h3>" .$assoc[$counter]['username']. " | Status: Online</h3>";
			echo "<p>Rating:" .$assoc[$counter]['score_avg']." </p>"
		}
	}
} else {
	echo "group rating and matching invalid";
	header("Location: ../landing.html");
}

function findOppositeRole(role) {
	$new_role = "";
	if (role == "listener") {
		$new_role = "speaker";
	}
	if (role == "speaker") {
		$new_role = "listener";
	}
	return $new_role;
}


?>