<?php
  require_once("config.php");

  session_start();
  if(!empty($_POST)){
    $query = "
              SELECT
                  uid,
                  username,
                  password,
                  salt,
                  email
              FROM users
              WHERE email=:email";

    $query_params = array(
        ':email' => $_POST['email']
    );

    $query_result = mysql_query($query);

    $num_row = mysql_num_rows($query_result);
    $row = mysql_fetch_assoc($query_result);

    $login_valid = false;

    if($num_row == 1) {
      echo 'true';
      $check_password = hash('sha256', $_POST['password'] . $row['salt']);
      for($round = 0; $round < 65536; $round++){
          $check_password = hash('sha256', $check_password . $row['salt']);
      }
      if($check_password === $row['password']){
          $login_valid = true;
      }
    }

    if ($login_valid = true) {
      unset($row['salt']);
      unset($row['password']);
      $_SESSION['user'] = $row;
      //$_SESSION['username'] = $row['username'];
      //$_SESSION['uid'] = $row['uid'];
    } else {
      echo 'login failed';
    }

?>
