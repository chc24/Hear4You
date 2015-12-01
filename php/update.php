<?php
require("config.php");
session_start();


if (!$_SESSION["user"]) die;
	if(!empty($_POST)) {
      // add user into online
      if (!empty($_POST["speaker"])) {
      	$role = $_POST["speaker"];
      }
      if (!empty($_POST["listener"])) {
      	$role = $_POST["listener"];
      }
      if (!empty($_POST["groupchat"])) {
      	$role = $_POST["groupie"];
      }
      $query = "
        INSERT INTO `online` (
          `username`,
          `role`
        ) VALUES (
          :username,
          :role
        )";

      $query_params = array(
        ':username' => $_SESSION["username"],
        ':role' => $role,
      );

      print_r($query_params);

      try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
        if ($result) {
          echo "online user added";
        }
      } catch(PDOException $e){
        die("query failed: " . $e->getMessage());
      }

      header("Location: ../individualchat.php");

?>