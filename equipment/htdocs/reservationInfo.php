<?php
require '../include/conf/const.php';
  session_start();
    function getPdodata() {
      $pdo = new PDO(
          'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset='.DB_CHARSET,
          DB_USER,
          DB_PASSWORD,
          [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          ]
      );
      return $pdo;
  }
  if(isset($_POST['aaa'])){

    $sql = "UPDATE ";
    $sql .= "t_application ";
    $sql .= "SET ";
    $sql .= "application_status = 1 ";
    $sql .= "WHERE application_id = :application_id";
    
    $pdo = getPdodata();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':application_id', $_POST['aaa']);
    $stmt->execute();
}
if(isset($_POST['bbb'])){

    $sql = "UPDATE ";
    $sql .= "t_application ";
    $sql .= "SET ";
    $sql .= "application_status = 2 ";
    $sql .= "WHERE application_id = :application_id";
    
    $pdo = getPdodata();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':application_id', $_POST['bbb']);
    $stmt->execute();
}

  $sql = "SELECT ";
  $sql .= "t_a.application_id,t_a.student_id,t_a.borrowing_time, t_a.return_time, t_a.application_remarks, t_a.application_status, ";
  $sql .= "t_e.equipment_name ";
  $sql .= "from t_application t_a join t_application_detail t_ad on t_a.application_id = t_ad.application_id ";
  $sql .= "join t_equipment t_e on t_ad.equipment_id = t_e.equipment_id ";
  $sql .= "WHERE t_a.borrowing_time = :borrowing_time ";
  $sql .= "ORDER BY t_a.borrowing_time DESC";
      $pdo = getPdodata();
      $stmt = $pdo->prepare($sql);

$nowTime = date("Y-m-d");
      $stmt->bindValue(':borrowing_time', $nowTime);
      $stmt->execute();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>貸出処理画面 - 備品管理システム</title>

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
      <li class="nav-item">
        <a class="nav-link" href="../htdocs/top.php">トップページ </a>
      </li>

      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">貸出</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="#">貸出処理<span class="sr-only">(current)</span></a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="./adminlogin.php" method="post">
    
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >ログアウト</button>
    </form>
  </div>
</nav>

<main role="main">
</br>
</br>
</br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ユーザー</th>
      <th scope="col">備品名</th>
      <th scope="col">貸出日時</th>
      <th scope="col">返却日時</th>
      <th scope="col">備考</th>
      <th scope="col">申請状態</th>
      <th scope="col">状態変更</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    while ($row = $stmt->fetch()) {
    ?>
    <tr>
      <th scope="row"><?=$row['student_id']?></th>
      <td><?=$row['equipment_name']?></td>
      <td><?=$row['borrowing_time']?></td>
      <td><?=$row['return_time']?></td>
      <td><?=$row['application_remarks']?></td>
      <td>
        <?php
    switch($row['application_status']){
    case "0":
      echo '予約中';
      break;
    case '1':
      echo '貸出中';
      break;
    case '2':
      echo '返却済み';
      break;
    case '3':
      echo 'キャンセル済み';
      break;
  }?>
        </td>
        <td>
        <?php
      switch($row['application_status']){
    case "0":
      echo '<form class="form-inline my-2 my-lg-0" action="" method="post">';
      echo '<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="aaa" value='.$row['application_id'].'>貸出中</button>';
      echo '</form>';
      break;
    case '1':
      echo '<form class="form-inline my-2 my-lg-0" action="" method="post">';
      echo '<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="bbb" value='.$row['application_id'].'>返却済み</button>';
      echo '</form>';
      break;
    case '2':
      //echo '返却済み';
      break;
    case '3':
      //echo 'キャンセル済み';
      break;
       } ?>
        </td>
    </tr>
  <?php } ?>
  </tbody>
</table>


</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script></body>
<script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>