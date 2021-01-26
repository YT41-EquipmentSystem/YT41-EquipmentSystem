<?php
namespace myapp\controller;
  // 設定ファイル読み込み
  require_once '../conf/common.php';

$params = array(
  'client_id' => CONSUMER_KEY,
  'redirect_uri' => CALLBACK_URL,
  'scope' => 'https://www.googleapis.com/auth/userinfo.profile email',
  'response_type' => 'code',
);

// 認証ページにリダイレクト
header("Location: " . AUTH_URL . '?' . http_build_query($params));
?>