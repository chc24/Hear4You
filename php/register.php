<?php
    require("config.php");

    if(!empty($_POST)) {

      //check for empty files
      if(empty($_POST['username'])) {
        die("Enter username");
      }
      if(empty($_POST['password'])) {
        die("Enter password");
      }
      if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid email");
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
        die("Username is in use.");
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
        die("Email address is in use.");
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
        //if ($result) {
        //  echo "User Created Successfully";
        //}
      } catch(PDOException $e){
        die("query failed: " . $e->getMessage());
      }

      header("Location: ../login.html");
    }
?>