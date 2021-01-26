<?php

namespace myapp;

use myapp\controller\AdminLoginController;
use myapp\model\CsrfValidator;

try{
  // 設定ファイル読み込み
  require_once '../include/conf/common.php';

  AdminLoginController::login();
} catch(\Exception $e) {
}

//if(isset($_SESSION['login'])){
//    Session::Check('destroy');
//}
if(!isset($_SESSION)){
session_start();
}
// ログイン画面を読み込む
include_once '../include/view/adminlogin.php';