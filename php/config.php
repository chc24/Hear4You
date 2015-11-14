<?php
    $username = "djp28";
    $password = "YK%_GHD7u3ge";
    $host = "cgi.cs.duke.edu";
    $dbname = "djp28";

    try {
      $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    } catch(PDOException $e){
      die("Failed to connect to the database: " . $e->getMessage());
    }

    header('Content-Type: text/html; charset=utf-8');
    session_start();
?>
