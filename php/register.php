/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/

<?php
    require("config.php");
    require("check.php");

    session_start();

    if(!empty($_POST)) {
      
      //check for empty files
      if(empty($_POST['username'])) {
        die("Enter username");
        $_SESSION['registered'] = false;
      }
      if(empty($_POST['password'])) {
        die("Enter password");
        $_SESSION['registered'] = false;
      }
      if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid email");
        $_SESSION['registered'] = false;
      }

      // Check if the username is already taken
      $query = "
            SELECT 1
            FROM users
            WHERE username = :username";
      $query_params = array(
        ':username' => $_POST['username']
      );

      try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
      } catch(PDOException $e){
        die("Failed to run query: " . $e->getMessage());
      }

      $row = $stmt->fetch();
      if($row){
        $_SESSION['registered'] = false;
        //header("Location: ../registerfail.html");
      }

      //check if email is already taken
      $query = "
            SELECT 1
            FROM users
            WHERE email = :email ";
      $query_params = array(
            ':email' => $_POST['email'] );
      try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
      } catch(PDOException $e){
        die("Failed to run query: " . $e->getMessage());
      }

      $row = $stmt->fetch();
      if($row){
        $_SESSION['registered'] = false;
        //header("Location: ../registerfail.html");
      }

      // add user into db
      $query = "
        INSERT INTO `users` (
          `username`,
          `email`,
          `password`,
          `salt`
        ) VALUES (
          :username,
          :email,
          :password,
          :salt
        )";

      // password security
      $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
      $password = hash('sha256', $_POST['password'] . $salt);

      for ($round = 0; $round < 65536; $round++) {
        $password = hash('sha256', $password . $salt);
      }
      $query_params = array(
        ':username' => $_POST['username'],
        ':email' => $_POST['email'],
        ':password' => $password,
        ':salt' => $salt,
      );

      //print_r($query_params);

      try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
        if ($result) {
          //user is created successfully, added to db
          $_SESSION['registered'] = true;
        }
      } catch(PDOException $e){
        die("query failed: " . $e->getMessage());
      }

      //$_SESSION['registered'] = true;
      //header("Location: ../login.html");
    }
?>
