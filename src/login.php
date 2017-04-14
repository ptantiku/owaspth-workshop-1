<?php
/* This is login page */

// deal with cookie (vulnerable by cookie manipulation)
if(empty($_COOKIE['username'])){
    setcookie('username', 'anonymous');
}else if($_COOKIE['username']=='admin'){
    header('Location: admin.php');
    exit;
}

// password checking (vulnerable by sql injection)
if(!empty($_POST['username']) || !empty($_POST['password'])){
    require('config.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from users where username='$username' and password='$password'";

    $result = mysql_query($sql);
    if($result===false) echo mysql_error($db);

    $user = mysql_fetch_assoc($result);  //fetch first user

    if(empty($user)){
        $user = false;
        $error_msg = 'Error: invalid username or password';
    }else{
        setcookie('username', $user['username']);
        $success_msg = 'Success: logged in successfully.';
        header('Location: index.php');
    }

    echo "$sql";	//for debug
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="public/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="public/style.css">
  <script src="public/js/jquery.min.js"></script>
  <script src="public/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="public/style.css">;
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="center">
          <h3>This is for users only!</h3>
          <p>Please login to continue</p>
          <?php if(isset($success_msg)): ?>
            <div class="alert alert-success">
              <i class="glyphicon glyphicon-info-sign"></i>
              <?php echo $success_msg; ?>
            </div>
          <?php endif; ?>
          <?php if(isset($error_msg)): ?>
            <div class="alert alert-danger">
              <i class="glyphicon glyphicon-exclamation-sign"></i>
              <?php echo $error_msg; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" method="POST" action="">
          <div class="form-group">
            <label class="form-label" for="username">Username: </label>
            <input id="username" name="username" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label" for="password">Password: </label>
            <input id="password" name="password" type="password" class="form-control">
          </div>
          <button type="submit" class="form-control">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
