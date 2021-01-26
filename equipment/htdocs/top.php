<?php
namespace myapp;

use myapp\model\CsrfValidator;

require_once '../include/conf/common.php';

session_start();

try {
    // トップページにリダイレクトした際に行う処理
    if(!isset($_SESSION['login'])){
        CsrfValidator::validate(filter_input(INPUT_POST, 'token'), true);
        // ログイン時にはセッションIDを更新する
        session_regenerate_id(true);
        // ログイン成功情報を保存
        $_SESSION['login'] = true;

    }
    include_once '../include/view/top.php';

} catch (\RuntimeException $e) {
    // エラー時は管理者ログイン画面にリダイレクト
    header('Location: ./adminLogin.php');
}


