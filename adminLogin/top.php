<?php
//===============================
//ログイン後のページ(仮)
//===============================
session_start();
// アクセストークンを取得する関数を使えるようにする
include_once("src/php/CSRFTOKEN.php");

try {
    CsrfValidator::validate(filter_input(INPUT_POST, 'token'), true);
    // ログイン時にはセッションIDを更新する
    session_regenerate_id(true);
    // トップページにリダイレクトした際に行う処理
    if(isset($_SESSION['login'])){
      echo 'ようこそ';
    }
    
} catch (\RuntimeException $e) {
    // コメントアウト文はログ出力させる
    //header('Content-Type: text/plain; charset=UTF-8', true, $e->getCode() ?: 500);
    //die($e->getMessage());

    // エラー時は管理者ログイン画面にリダイレクト
    header('Location: adminLogin.php');
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
  <p></p>
</form>
</body>
</html>