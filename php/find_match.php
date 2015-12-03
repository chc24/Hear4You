<?php
require("config.php");
session_start();

$query = "SELECT username FROM online WHERE $_SESSION['role'] <> role";
$stmt   = $db->prepare($query);
$result = $stmt->execute($query_params);


?>