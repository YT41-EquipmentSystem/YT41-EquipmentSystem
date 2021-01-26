<?php
namespace myapp;
// 設定ファイル読み込み
  require_once '../include/conf/common.php';
use myapp\controller\ReservationRequestController;

  // 予約申請用のデータ取得
  session_start();
try{
  
  // 一覧で格納されるもの
  $_SESSION['quantity'] = '1';
  ReservationRequestController::request();
} catch(\Exception $e) {

}

// 予約申請画面を読み込む
include_once '../include/view/reservationRequest.php';
