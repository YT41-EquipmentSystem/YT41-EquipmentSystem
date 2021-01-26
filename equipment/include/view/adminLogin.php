<?php
namespace myapp\view;

use myapp\model\CsrfValidator;

require_once '../include/conf/common.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>管理者ログイン - 備品管理システム</title>

    <link href="../lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" media="screen" href="../include/view/css/adminLogin.css" rel="stylesheet" />
  
  </head>
  <body>
    <h1>
      <img class="mb-4" src="../icon/admin_login.svg" alt="" width="72" height="72">管理者ログイン</h1>
    <form id ="form-signin" action="" method="post">
    <!-- titletext -->
  <div class="text-center mb-4">
    <h2 class="h3 mb-3 font-weight-normal">Please sign in</h2>
    <p>メールアドレスとパスワードを入力してログインしてください。</p>
  </div>

  <!-- エラーメッセージ -->
  <?php
    if(!isset($_SESSION['error'])){
      //$_SESSION['error'] = "";
    }elseif($_SESSION['error'] != ""){
      $i = $_SESSION['error'];
      echo '<div class="errormessage">'.
           '<img class="errormessage-icon" src="../icon/admin_login_warning.svg" alt="" width="32" height="32">'.
           '<p class="errormessage-txt" name="errormessage" id="errormessage">'.$i.'</p>'.
           '</div>';
    }
    
  ?>

  <div class="form-label-group">
    <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" maxlength="255" required autofocus>
    <label for="inputEmail">Email address</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" maxlength="16" required>
    <label for="inputPassword">Password</label>
  </div>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy; YT-41 equipmentSystem</p>
  <input type="hidden" name="token" id="token" value="<?=CsrfValidator::generate()?>">

  </form>
    <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>