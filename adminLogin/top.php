<?php
  session_start();
  if(isset($_SESSION['EMAIL'])){
    echo 'ようこそ' .  $_SESSION['EMAIL'] . "さん<br>";
  }
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>トップ - 備品管理システム</title>
</head>
<body>
<form id ="loginInfo">
  <p>ログイン成功</p>
</form>
</body>
</html>