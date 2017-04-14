<?php
// query books from database
require('config.php');
if(empty($_GET['query'])){
    $sql = 'select * from books limit 10';
    echo "$sql";	//for debug
    $result = mysql_query($sql);
}else{
    $query = '%'.$_GET['query'].'%';
    $sql = "select * from books where title like '$query' limit 10";
    echo "$sql";	//for debug
    $result = mysql_query($sql);
    if($result===false) echo mysql_error($db);
}

// pull data from database into $books
$books = array();
if($result) {
    while($row = mysql_fetch_array($result)){
        array_push($books, $row);
    }
    mysql_free_result($result);
}
mysql_close($db);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>OWASP-TH</title>
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
        <a class="navbar-brand" href="#">OWASP-TH Workshop 1: Team 1</a>
      </div><!--/.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->

  <div class="container">

    <div class="row">
      <div class="col-md-12 center">
        <h1>Welcome to OWASP-TH Workshop 1</h1>
        <h4>You need to login to see the page.</h4>
        <h4><a class="label label-primary" href="login.php">Login here</a></h4>
      </div>
    </div><!-- /.row -->

    <hr/>

    <div id="search-form" class="row">
      <div class="col-md-12">
        <form class="form-horizontal" method="GET" action="">
          <div class="form-group">
            <div class="input-group">
              <input id="query" name="query" type="text" class="form-control" placeholder="Search for books using title or author name ...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div><!-- /#search-form -->

    <div id="search-result" class="row">
      <div class="col-md-12">
        <h4>Search for: <?php echo $_GET['query']; ?></h4>
      </div>
      <div class="col-md-12">
        <?php if(!empty($books)): ?>
          <!-- search result -->
          <table class="table table-condensed table-hover table-striped">
            <thead>
              <tr>
                <th class="col-md-2">ID</th>
                <th class="col-md-5">Title</th>
                <th class="col-md-5">Author</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($books as $book): ?>
              <tr>
                <td><?php echo $book[0]; ?></td>
                <td>
                    <a href="item.php?id=<?php echo $book[0];?>">
                    <?php echo $book[1]; ?>
                    </a>
                </td>
                <td><?php echo $book[2];?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div><!-- /#search-result -->

  </div><!-- /.container -->

</body>
</html>
