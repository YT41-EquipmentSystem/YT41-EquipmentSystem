<?php

session_start();

if(isset($_SESSION['EMAIL'])){
  header('Location: ./top.html');
　exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <link type="text/css" media="screen" href="./css/adminLogin.css" rel="stylesheet" />
    <meta charset="utf-8" />
    <title>管理者ログイン - 備品管理システム</title>
    </head>
  <body>
    <form id ="loginInfo">
    <p class="form-title">ログイン</p>
    <p>メールアドレス</p>
        <p id="mail"><input type="text" name="mail" /></p>
    <p>パスワード</p>
        <p id="pass"><input type="password" name="pass" /></p>
      <p name="errormessage" id="errormessage"></p>
      <div class="login_buttons">
        <button type="button" id="login_button" name="send" value="ログイン" onclick="return false">ログイン</button></p>
      </div>
    </form>
    <script type="text/javascript" src="./src/js/adminLogin.js"></script>
  </body>
</html>