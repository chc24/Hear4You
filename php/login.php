<?php
  require_once 'config.php';

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
      WHERE username=:username";

    $query_params = array(
        ':username' => $_POST['username']
    );

    $query_result = mysql_query($query);

    $num_row = mysql_num_rows($res);
    $row=mysql_fetch_assoc($res);

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

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hear4You</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <?php include('nav.php'); ?>
	<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default LoginForm">
                <div class="panel-heading"> <strong class="">Login</strong>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label class="">
                                        <input type="checkbox" class="">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm sign">Sign in</button>
                                <button type="reset" class="btn btn-default btn-sm">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">Not Registered? <a href="#" class="">Register here</a>
                </div>
            </div>

            <div class="panel panel-default RoleForm" style="display:none">
                <div class="panel-heading"> <strong class="">Select Your Role</strong>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default btn-sm sign">Speaker</button>
                                <button type="reset" class="btn btn-default btn-sm">Listener</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">Unsure on Role? <a href="#" class="">Learn here</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

$(document).ready(function(){
  $(".sign").click(function(){
 	$(".LoginForm").fadeOut(500);
 	$(".RoleForm").fadeIn(500);
  });
});

</script>

</body>

</html>
