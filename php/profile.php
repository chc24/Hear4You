<?php
    require("config.php");
    unset($_SESSION['user']);
    header("Location: index.html");
    session_destroy();
?>
