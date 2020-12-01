<?php
// 設定ファイル読み込み
require_once '../include/conf/const.php';
// トークン確認用のmodel読み込み
require_once '../include/model/csrftoken.php';
require_once '../include/model/function.php';

session_start();

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
// ログイン画面を読み込む
include_once '../include/view/adminlogin.php';