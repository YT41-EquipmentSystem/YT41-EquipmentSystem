<?php
session_start();

include_once('src/php/CSRFTOKEN.php');

// ログイン済みの場合にセッション情報を破棄する
if(isset($_SESSION['login'])){
    // セッション変数を全て解除する
    $_SESSION = array();
    // セッションを切断するにはセッションクッキーも削除する。
    // セッション情報だけでなくセッションを破壊する。
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // 最終的に、セッションを破壊する
    session_destroy();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>管理者ログイン - 備品管理システム</title>
    </head>
  <body>
    <form id ="loginInfo" action="./src/php/db/login.php" method="post">
      <input type="hidden" name="token" id="token" value="<?=CsrfValidator::generate()?>">
      <p>メールアドレス： <input type="text" name="mail" id="mail"></p>
      <p>パスワード： <input type="password" name="pass" id="pass"></p>
      <p name="errormessage" id="errormessage"></p>
      <div class="login_buttons">
        <button type="submit">ログイン</button></p>
      </div>
    </form>
  </body>
</html>