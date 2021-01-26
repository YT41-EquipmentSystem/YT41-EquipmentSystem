<?php
namespace myapp\controller;

use \myapp\model\ReservationRequestModel;
use \myapp\conf\Db;
use \myapp\conf\ExceptionCode;
use \myapp\conf\InvalidErrorException;

  // 設定ファイル読み込み
  require_once '../include/conf/common.php';
  
class ReservationRequestController{
        // 予約申請が可能な場合、申請確認ページへ遷移
  const TARGET_PAGE = '../../htdocs/reservationSuccess.php';
  /**
   * 予約データ取得
   * @return
   */
  static public function request(){
    // POSTされていない時は、処理を中断
    if(!filter_input_array(INPUT_POST)){
      return;
    }

    // 予約申請画面の情報を取得
    //session_start();
    $getid = $_SESSION['id']; //id複数
    $getborrowing_time = filter_input(INPUT_POST,'borrowingTime');
    $getreturn_time = filter_input(INPUT_POST,'returnTime');
    $getapplication_remarks = filter_input(INPUT_POST,'applicationRemarks');
    // トランザクションを開始
    Db::transaction();

    // 備品IDから備品モデルを取得
    $objReservationRequestModel = new ReservationRequestModel();
    $objReservationRequestModel->getModelByEquipmentId($getid);
    // 予約可能かチェック
    try{
      if(!$objReservationRequestModel->checkTime($getborrowing_time, $getreturn_time)){
        throw new InvalidErrorException(ExceptionCode::INVALREQUEST_DATE);
      }
      if(!$objReservationRequestModel->checkHoldingQuantity($getborrowing_time, $getid)){
        throw new InvalidErrorException(ExceptionCode::INVALREQUEST_RESERVATION_MAX);
      }
      // 予約する
      if(!$objReservationRequestModel->reservationRequest($getid,$getborrowing_time,$getreturn_time,$getapplication_remarks)){
        throw new InvalidErrorException(ExceptionCode::INVALREQUEST_RESERVATION_MAX);
      }
      // 申請データをコミットする
      Db::commit();
      $_SESSION['errorR'] = "";

    //ページ遷移
    header(sprintf("location: %s", self::TARGET_PAGE), true, 307);

    } catch (InvalidErrorException $e){
      // 予約不可のときエラーを吐く
      $_SESSION['errorR'] = $e->getMessage();
    }
  }
}