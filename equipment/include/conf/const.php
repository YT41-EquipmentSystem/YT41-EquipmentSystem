<?php
// 設定ファイル
define('DB_HOST',     'localhost');       // データベースのホスト名
define('DB_USER',     'test');            // MYSQLのユーザ名
define('DB_PASSWORD', 'test');            // MYSQLのパスワード
define('DB_NAME',     'equipmentsystem'); // データベース名
define('DB_CHARSET',  'utf8mb4');         // データベース文字エンコーディング

// php.iniのallow_url_include = On にする
define('PORT', 'localhost:8081'); // ポートの指定
define('LOCATION', 'http://'.PORT);

// ユーザーログインに必要
// アプリケーション設定
define('CONSUMER_KEY', '37320831151-qmejbqa1lv9t3bescsof9b7s96r5crnk.apps.googleusercontent.com');

define('CALLBACK_URL', LOCATION.'/student_login/oauth.php');

define('CONSUMER_SECRET', 'YbNjsEgj7JiZuZDiALcmGQGp');
// URL
define('AUTH_URL', 'https://accounts.google.com/o/oauth2/auth');
define('TOKEN_URL', 'https://accounts.google.com/o/oauth2/token');
define('INFO_URL', 'https://www.googleapis.com/oauth2/v1/userinfo');

/**
 * 開発モード
 */
define('DEVELOPPING', 1);

/**
 * 本番モード
 */
define('PRODUCTION', 2);

define('BASE_DIR', __DIR__);