<!DOCTYPE html>
<html>
  <head>
    <link type="text/css" media="screen" href="../include/view/css/adminLogin.css" rel="stylesheet" />
    <meta charset="utf-8" />
    <title>管理者ログイン - 備品管理システム</title>
  </head>
  <body>
    <form id ="loginInfo" action="../../htdocs/adminlogin-check.php" method="post">
      <h1>管理者ログイン</h1>
      <hr>
        <div align="center">
          <table border="0">
          <tr>
            <td colspan="2" class="error_message">
              <p name="errormessage" id="errormessage"><?=ErrorMessage::getErrorMessage()?></p>
            </td>
          </tr>
          <tr>
            <th class="login_field">
              <p >メールアドレス</p>
            </th>
            <td class="login_field">
              <input type="text" name="mail" id="mail" maxlength="255">
            </td>
          </tr>
          <tr>
            <th class="login_field">
              <p>パスワード</p>
            </th>
            <td class="login_field">
              <input type="password" name="pass" id="pass" maxlength="16">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="login_button">
              <button type="submit">ログイン</button>
            </td>
          </tr>
          <input type="hidden" name="token" id="token" value="<?=CsrfValidator::generate()?>">
        </form>
  </body>
</html>