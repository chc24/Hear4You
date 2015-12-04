<?php
/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/

require('config.php');

if (isset($_SESSION['room_full']) {
	$_SESSION['room_full'] = false;
}

$query = 'DELETE FROM rooms_open WHERE id = :id'];
$result = $db->prepare($query)
$result->bindParam(":id", $_SESSION['roomID']);	

if ($result->execute()) {
	header("Location: ../landing.html");
}	

?>