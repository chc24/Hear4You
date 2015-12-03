<?php
require("config.php");
require("check.php");

session_start();

if(isset($_SESSION['username'])) {
	//echo "user session exists";
	if(!empty($_POST)) {
		  //echo "post data exists";

      // add user into online
      if (!empty($_POST['speaker'])) {
      	$role = $_POST['speaker'];
      }
      if (!empty($_POST['listener'])) {
      	$role = $_POST['listener'];
      }
      if (!empty($_POST['group'])) {
      	$role = $_POST['group'];
      }

      //set session role var
      $_SESSION['chat_type'] = $role;

      // Check if the username is assigned to role
      $query = "
            SELECT 1
            FROM online
            WHERE username = :username
            AND role <> :role";
      $query_params = array(
        ':username' => $_SESSION['username'],
        ':role' => $role
      );

      try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
      } catch(PDOException $e){
        die("Failed to run query: " . $e->getMessage());
      }

      $row = $stmt->fetch();
      if($row){
        $query = "
              UPDATE online SET role = :role
              WHERE username = :username";
        $query_params = array(
	        ':username' => $_SESSION['username'],
	        ':role' => $role
        );

        try {
          $stmt = $db->prepare($query);
          $result = $stmt->execute($query_params);
        } catch(PDOException $e){
          die("Failed to run query: " . $e->getMessage());
        }

        $_SESSION['chat_ready'] = true;
        //header("Location: ../individualchat.html");
      } else {
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
	      } catch(PDOException $e){
	        die("query failed: " . $e->getMessage());
	      }

        $_SESSION['chat_ready'] = true;
	      //header("Location: ../individualchat.html");
      }

  }
}

?>