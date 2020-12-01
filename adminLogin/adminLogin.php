<?php

session_start();

if (isset($_SESSION['EMAIL'])) {
  header('Location: ./top.html');
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
  <form id="loginInfo">
    <h1>管理者ログイン</h1>
    <hr>
    <div align="center">
      <table border="0">
        <form action="list.html">
          <tr>
            <th class="login_field">
              メールアドレス
            </th>
            <td class="login_field">
              <input type="text" name="mail" id="mail">
            </td>
          </tr>
          <tr>
            <th class="login_field">
              パスワード
            </th>
            <td class="login_field">
              <input type="password" name="pass" id="pass">
            </td>
          </tr>
          <p name="errormessage" id="errormessage"></p>
          <tr>
            <td colspan="2" class="login_button">
              <button type="button" id="login_button" name="send" value="ログイン" onclick="return false">ログイン</button>
            </td>
          </tr>
        </form>
        <script type="text/javascript" src="./src/js/adminLogin.js"></script>
</body>

</html>