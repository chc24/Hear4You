<?php

/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/
require("config.php");
//require("check.php");

//session_start();

function findOppositeRole($role) {
	$new_role = "";
	if ($role == "Listener") {
		$new_role = "Speaker";
	}
	if ($role == "Speaker") {
		$new_role = "Listener";
	}
	return $new_role;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];

	if ($role != "group") {
		$query = 'SELECT * FROM rooms_open WHERE role = :role';
		$result = $db->prepare($query);
		$result->bindParam(":role", findOppositeRole($role));	

		if($result->execute()) {
			$assoc = $result->fetchAll(PDO::FETCH_ASSOC);
			$count = sizeof($assoc);

			if ($count == 0) {
				$room_id = generateRandomString(10);
				$query = 'INSERT INTO rooms_open VALUES (:id, :role)';
			}
			else {
				$room_id = $assoc[$count-1]['id'];
				$query = 'UPDATE rooms_open SET role = :role WHERE id = :id';
				//echo '<h5>'.$assoc[$count-1]['id'].'</h5>';
			}

			$_SESSION['roomID'] = $room_id;

			$query_params = array(
				':id' => $room_id,
				':role' => $role
			);

			try {
				$stmt = $db->prepare($query);
			    $result = $stmt->execute($query_params);
			} catch(PDOException $e){
			    die("Failed to run query: " . $e->getMessage());
			}

			header('Location: ../individualchat.php');
	    }
	}
}



	// $query = '
	// 	SELECT username, AVG(score) as score_avg
	// 	FROM (SELECT o.username, u.id
	// 		  FROM online o, users u
	// 		  WHERE o.role = :role AND o.username = u.username) AS online_usernames,
	// 		 rating r
	// 	WHERE online_usernames.id = r.recip_id
	// 	GROUP BY online_usernames.id';

	//$result = $db->prepare($query);
	//$result->bindParam(":role", findOppositeRole($role));
	
	// if($result->execute()) {
	// 	$assoc = $result->fetchAll(PDO::FETCH_ASSOC);
	// 	$counter = sizeof($assoc);
	// 	while($counter >= 0) {
	// 		$counter=$counter-1;
	// 		echo "<h3>" .$assoc[$counter]['username']. " | Status: Online</h3>";
	// 		echo "<p>Rating:" .$assoc[$counter]['score_avg']." </p>";
	// 	}
	// }
//} else {
//	echo "group rating and matching invalid";
	//header("Location: ../landing.html");
//}

?>