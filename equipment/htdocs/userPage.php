<?php

  session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ユーザー画面</title>

    <link href="../lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" media="screen" href="../include/view/css/userPage.css" rel="stylesheet" />
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

    <link href="data/user.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">備品申請予約システム</a>

      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="./itiran_gamen/gamen.php">備品一覧</a>
      </li>
    </ul>
    <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
        <a class="nav-link" href="">マイページ <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <ul class="navbar-nav px-3">

    <li class="nav-item text-nowrap">
      <a class="nav-link" href="../student_login/login.php">ログアウト</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="">
              <span data-feather="home"></span>
              ユーザー情報 <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./userReservation.php">
              <span data-feather="file"></span>
              申請予約履歴
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">ユーザー情報</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div> 
      </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">ログイン情報</h6>
    <div class="media text-muted pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">メールアドレス:</strong>
        <?=$_SESSION['email']?>
      </p>
    </div>
    <div class="media text-muted pt-3">
      <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <strong class="d-block text-gray-dark">名前：</strong>
        <?=$_SESSION['family_name']." ".$_SESSION['given_name']?>
      </p>
    </div>
  </div>

    </main>

  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="data/user.js"></script>
<script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
      </body>
</html>