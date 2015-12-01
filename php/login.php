<?php
require("config.php");
session_start();

if($_SESSION['logged_in'] == false) {
    if(!empty($_POST)) {
        $query = "
                SELECT
                    username,
                    password,
                    salt,
                    email
                FROM users
                WHERE email=:email";
        
        $query_params = array(
            ':email' => $_POST['email']
        );
        
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
        
		$login_valid = false;
		$num_row     = 0;
		
        if($result) {
			$num_row = $stmt->rowCount();
			if($num_row >= 1) {
				$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$check_password = hash('sha256', $_POST['password'] . $row[0]['salt']);
				for($round = 0; $round < 65536; $round++) {
					$check_password = hash('sha256', $check_password . $row[0]['salt']);
				}
				
				if($check_password == $row[0]['password']) {
					unset($row['salt']);
					unset($row['password']);
					//$_SESSION['user'] = $row['username'];
					$_SESSION['logged_in'] = true;
					$_SESSION['username'] = $row[0]['username'];
					//$_SESSION['uid'] = $row['uid'];
					header("Location: ../landing.html");
				} else {
					echo "Login failure: could not find that username/pass";
				}
			} else {
				echo "Login failure: could not find that username/pass";
			}
		}
    } else {
        echo "No POST vars defined";
    }
} else {
    echo "You're already logged in. <a href='logout.php'>Logout</a>";
}

?>
