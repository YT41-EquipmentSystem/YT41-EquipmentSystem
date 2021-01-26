<?php
require_once 'const.php';

//本番の時には PRODUCTION に書き換える
define('MODE', DEVELOPPING);

//  開発モードのときにエラーを表示する
if (MODE === DEVELOPPING) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', false);
}
//require_once "../vendor/autoload.php";
require_once __DIR__ ."/../../vendor/autoload.php";