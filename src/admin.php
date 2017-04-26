<?php
/*
 * admin.php
 * - only logged in user can see
 * - check status of file, using "stat <file.pdf>"
 */

require('config.php');

// deal with cookie (vulnerable by cookie manipulation)
if(empty($_COOKIE['username'])){
    setcookie('username', 'anonymous');
}else if($_COOKIE['username']=='anonymous'){
    header('Location: login.php');
    exit;
}else{
    $username = $_COOKIE['username'];
}

// list all files in upload folder
$file_list = array_diff(scandir('upload/'), array('.','..'));
if(!empty($_GET['query'])){

    // using Linux command "stat" to see file's status
    $query = $_GET['query'];
    $result = shell_exec("stat upload/$query");

}

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>OWASP-TH: Admin Page</title>
  <link rel="stylesheet" href="public/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="public/style.css">
  <script src="public/js/jquery.min.js"></script>
  <script src="public/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="public/style.css">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">OWASP-TH Workshop 1: <?php echo $team; ?></a>
      </div><!--/.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="admin.php">Admin</a></li>
        </ul><!-- /.navbar -->
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" class="username"><?php echo $username; ?></a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul><!-- /.navbar-right -->
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->

  <div class="container">

    <div id="header" class="row">
      <h1>OWASP-TH Workshop 1: Admin Page</h1>
      <p>
        You're logged in as
        <span class="username"><?php echo $_COOKIE['username']; ?></span>
      </p>
    </div><!-- /#header -->

    <div id="body" class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <h2>File Management</h2>

            <div class="row">
              <div class="col-md-12">
                File list:<br/>

                <?php foreach($file_list as $file): ?>

                  <a class="label label-default" href="admin.php?query=<?php echo $file; ?>">
                    <?php echo $file;?>
                  </a>

                <?php endforeach; ?>

              </div>
            </div>
            <br/>

            <form class="form-horizontal col-md-12" method="GET" action="">
              <div class="form-group">
                <div class="input-group">
                  <input id="query" name="query" type="text" class="form-control"
                    placeholder="Enter file name here to check file size ..."/>
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Check</button>
                  </span>
                </div>
              </div>
            </form><!-- /form -->

            <?php if(!empty($_GET['query'])):   // if query, show result ?>

              <div id="result" class="row">
                <div class="col-md-12">
                  <pre><?php echo $result; ?></pre>
                </div>
              </div><!-- /#result -->

            <?php endif; ?>

          </div>
        </div><!-- /.row -->
      </div>
    </div><!-- /#body -->

  </div><!-- /.container -->

</body>
</html>
