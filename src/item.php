<?php
/* WARNING: This code is vulnerable. */
/*
 * item.php
 * Display each book info.
 */

require('config.php');

// deal with cookie
if(empty($_COOKIE['username'])){
    setcookie('username', 'anonymous');
    $username = 'anonymous';
}else {
    $username = $_COOKIE['username'];
}

//check if logged in
if ($username == 'anonymous'){
    $loggedin = false;
}else{
    $loggedin = true;
}

// query books from database
if(empty($_GET['id'])){
    // not given id, go to index.php
    header('Location: index.php');
    exit();
}else{
    // given id, get book from database
    $sql = "select * from books where id=".$_GET['id'];
}

$result = mysql_query($sql);
if($result){
    $book = mysql_fetch_assoc($result);
    mysql_free_result($result);
    mysql_close($db);
}else{
    echo mysql_error($db);
}
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
        <a class="navbar-brand" href="#">
            <img src="public/img/logo_sm.png" alt="OWASP Thailand Logo"/>
            OWASP-TH Workshop 1: <?php echo $team; ?>
        </a>
      </div><!--/.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>

          <?php if($loggedin): ?>

            <li><a href="admin.php">Admin</a></li>

          <?php endif; ?>

        </ul><!-- /.navbar -->
        <ul class="nav navbar-nav navbar-right">

          <?php if($loggedin): ?>

            <li><a href="#" class="username"><?php echo $username; ?></a></li>
            <li><a href="logout.php">Logout</a></li>

          <?php else: ?>

            <li><a href="login.php">Login</a></li>

          <?php endif; ?>

        </ul><!-- /.navbar-right -->
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->

  <div class="container">

    <div id="header" class="row">
      <div class="col-md-12 center">
        <h1>OWASP-TH Workshop 1</h1>
        <h4>View Item <?php echo $_GET['id']; ?></h4>
      </div>
    </div><!-- /#header -->

    <hr/>

    <?php if(empty($book)): //no book info ?>

      <div class="col-md-6 col-md-offset-3">
        No book found
      </div>

    <?php else: // has book info ?>

      <div class="col-md-6 col-md-offset-3">
        <div id="item-header" class="row">
          <div class="col-md-4">
            <!-- mock-up book's cover -->
            <img src="public/img/book.png" class="item-img"/>
          </div>
          <div class="col-md-8">
            <!-- print book data -->
            <div class="item-label">ID:</div>
            <div class="item-detail"><?php echo $book['id']; ?></div>
            <div class="item-label">Title:</div>
            <div class="item-detail"><?php echo $book['title']; ?></div>
            <div class="item-label">Author:</div>
            <div class="item-detail"><?php echo $book['author']; ?></div>
          </div>
        </div><!-- /#item-header -->

        <hr/>

        <div class="row">
          <div class="col-md-12 item-info">
            <h4>Book Info:</h4>

            <!-- mock-up book info -->
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Callipho ad virtutem nihil adiunxit nisi voluptatem, Diodorus vacuitatem doloris.
            Nec lapathi suavitatem acupenseri Galloni Laelius anteponebat, sed suavitatem ipsam
            neglegebat; Vitae autem degendae ratio maxime quidem illis placuit quieta.
            Duo Reges: constructio interrete. </p>

            <p>Satisne vobis videor pro meo iure in vestris auribus commentatus? Claudii libidini,
            qui tum erat summo ne imperio, dederetur. Sed eum qui audiebant, quoad poterant,
            defendebant sententiam suam. Tuo vero id quidem, inquam, arbitratu. Illum mallem levares,
            quo optimum atque humanissimum virum, Cn. </p>

            <p>Ea possunt paria non esse. Bestiarum vero nullum iudicium puto. Duarum enim vitarum
            nobis erunt instituta capienda. Fortemne possumus dicere eundem illum Torquatum?
            Sed utrum hortandus es nobis, Luci, inquit, an etiam tua sponte propensus es?
            Illud mihi a te nimium festinanter dictum videtur, sapientis omnis esse semper beatos;
            Stoicos roga. </p>

            <p>Non igitur de improbo, sed de callido improbo quaerimus, qualis Q. Itaque primos
            congressus copulationesque et consuetudinum instituendarum voluntates fieri propter
            voluptatem; Hoc enim constituto in philosophia constituta sunt omnia. Roges enim
            Aristonem, bonane ei videantur haec: vacuitas doloris, divitiae, valitudo; </p>
          </div>
        </div><!-- /.item-info -->
      </div>

    <?php endif; ?>

  </div><!-- /.container -->

</body>
</html>
