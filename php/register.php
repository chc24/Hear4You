<?php
    require("config.php");

    if(!empty($_POST)) {
      if(empty($_POST['username'])) {
        die("Enter username");
      }
      if(empty($_POST['password'])) {
        die("Enter password");
      }
      if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Invalid email");
      }

      // add user into db
      $query = "
        INSERT INTO users (
          username,
          password,
          salt,
          email
        ) VALUES (
          :username,
          :password,
          :salt,
          :email
        )";

      // password security
      $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
      $password = hash('sha256', $_POST['password'] . $salt);

      for ($round = 0; $round < 65536; $round++) {
        $password = hash('sha256', $password . $salt);
      }
      $query_params = array(
        ':username' => $_POST['username'],
        ':password' => $password,
        ':salt' => $salt,
        ':email' => $_POST['email']
      );

      try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
      } catch(PDOException $e){
        die("query failed: " . $e->getMessage());
      }

      header("Location: login.php");
      die("Redirecting to login.php");
    }
?>
