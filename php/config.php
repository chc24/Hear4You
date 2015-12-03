/*
SOURCES, ATTRIBUTIONS, WHO DID WHAT:
Dennis: Created script
*/

<?php
  $providers = array(
    'Facebook'
  );

  // Facebook App id
  $fb_app_id = '1135644969798858';

  // mySQL credentials
  $username = "djp28";
  $password = "YK%_GHD7u3ge";
  $host = "cgi.cs.duke.edu";
  $dbname = "djp28";

  try {
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
  } catch(PDOException $e){
    die("Failed to connect to the database: " . $e->getMessage());
  }

  session_start();
  //require("check.php");
?>
