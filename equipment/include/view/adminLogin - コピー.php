<!DOCTYPE html>
<html>
  <head>
    <link type="text/css" media="screen" href="../include/view/css/adminLogin.css" rel="stylesheet" />
    <meta charset="utf-8" />
    <title>管理者ログイン - 備品管理システム</title>
    </head>
  <body>
    <form id ="loginInfo" action="../../htdocs/adminlogin-check.php" method="post">
      <input type="hidden" name="token" id="token" value="<?=CsrfValidator::generate()?>">
      <p>メールアドレス： <input type="text" name="mail" id="mail"></p>
      <p>パスワード： <input type="password" name="pass" id="pass"></p>
      <p name="errormessage" id="errormessage"><?=ErrorMessage::getErrorMessage()?></p>
      <div class="login_buttons">
        <button type="submit">ログイン</button></p>
      </div>
    </form>
  </body>
</html>

