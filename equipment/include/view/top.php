<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>トップ - 備品管理システム</title>

        <link href="../lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" media="screen" href="../include/view/css/top.css" rel="stylesheet" />
    </head>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="#">メニュー</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">トップページ <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">貸出</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="../../htdocs/reservationInfo.php">貸出処理</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" >
    
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">ログアウト</button>
    </form>
  </div>
</nav>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">備品管理システム</h1>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-4">
        <h2>貸出処理</h2>
        <p>備品の貸出・返却時に備品情報を変更します。</p>
        <p><a class="btn btn-secondary" href="../../htdocs/reservationInfo.php" role="button">処理画面へ &raquo;</a></p>
      </div>
    </div>
  </div> <!-- /container -->

</main>

<footer class="container">
  <p>&copy; YT-41 equipmentSystem</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>
<script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>