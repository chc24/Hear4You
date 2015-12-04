<?php
/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/

require("config.php");
//require("check.php");

session_start();

function contains($needle, $haystack) {
    return strpos($haystack, $needle) !== false;
}

//check if user sessions exists
if(isset($_SESSION['username'])) {
  //print_r($_SESSION);

  //checking if post data exist
	if(!empty($_POST)) {
      //set session role var
      //$_SESSION['chat_ready'] = false;

      // add user into online
      if (!empty($_POST['speaker'])) {
      	$role = $_POST['speaker'];
      }
      if (!empty($_POST['listener'])) {
      	$role = $_POST['listener'];
      }
      // if (!empty($_POST['group']) && contains("chat",$_POST['submit'])) {
      // 	$role = "group";
      // }
      
      $_SESSION['role'] = $role;
      //print_r($_SESSION);

      // Check if the username is assigned to role
      $query = "
            SELECT 1
            FROM online
            WHERE username = :username
            AND role <> :role";
      $query_params = array(
        ':username' => $_SESSION['username'],
        ':role' => $_SESSION['role']
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
	        ':role' => $_SESSION['role']
        );

        try {
          $stmt = $db->prepare($query);
          $result = $stmt->execute($query_params);
        } catch(PDOException $e){
          die("Failed to run query: " . $e->getMessage());
        }

        $_SESSION['chat_ready'] = true;
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
	        ':role' => $_SESSION['role']
	      );

	      try {
	        $stmt = $db->prepare($query);
	        $result = $stmt->execute($query_params);
	      } catch(PDOException $e){
	        die("query failed: " . $e->getMessage());
	      }

        $_SESSION['chat_ready'] = true;
      }
      header("Location: find_match.php");
      //require("check.php");
  }
}

?>