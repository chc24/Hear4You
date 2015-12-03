<?php
require("config.php");
session_start();

//remove the online status of user from db
$query = "
	DELETE FROM online
	WHERE username = :username";
$query_params = array(
	':username' => $_SESSION['username']
);

//removes all rows matching username
// $num_row = 1;

// while ($num_row > 0) {
// 	$stmt = $db->prepare($query);
//  $result = $stmt->execute($query_params);
//  $num_row = $stmt->rowCount();
// }

$stmt = $db->prepare($query);
$result = $stmt->execute($query_params);

//Clears session cookie and overall session data
if(isset($_COOKIE[session_name])) {
	setcookie(session_name(), "", time() - 3600, "/");
}

unset($_SESSION);
session_destroy();

header("Location: ../index.html");

?>
