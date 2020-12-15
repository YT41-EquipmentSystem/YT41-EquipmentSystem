<?php
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// トークン確認用のmodel読み込み
require_once '../include/model/csrftoken.php';
require_once '../include/model/function.php';

// セッション情報を破棄する
if(isset($_SESSION['login'])){
    Session::Check('destroy');
}

// ログイン画面を読み込む
include_once '../include/view/adminlogin.php';