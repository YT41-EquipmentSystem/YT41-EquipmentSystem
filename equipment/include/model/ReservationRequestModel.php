<?php

namespace myapp\model;

use myapp\dao\ReservationRequestDao;

/**
 * 予約申請モデル
 */
final class ReservationRequestModel
{
  // 備品テーブル
  private $_equipment_id = null;
  private $_equipment_name = null;
  private $_holding_quantity = null;
  private $_equipment_deletion_flag = null;

  // 予約申請テーブル

  /**
   * 備品IDから備品情報を検索する
   * @param  string $strEquipmentId
   * @return \Equipment\model\ReservationRequestModel
   */
  public function getModelByEquipmentId($strEquipmentId)
  {
      $dao = ReservationRequestDao::getDaoFromEquipmentId($strEquipmentId);
      return (isset($dao[0])) ? $this->setProperty(reset($dao)) : null;
  }

  // 貸出日時に借りる備品の在庫があるか判定する
  public function checkHoldingQuantity($strBorrowingTime, $intEquipmentId){
    // 貸出日時と借りる備品情報から予約件数を取得
    $daoCount = ReservationRequestDao::getDaoFromColumnCount($strBorrowingTime,$intEquipmentId);
    // 予約件数が保管数量未満かチェック
    if($this->getHoldingQuantity() > reset($daoCount)["count(*)"]){
      return true;
    }else{
    return false;
    }
  }
  // 現在日時の比較
  public function checkTime($strborrowingTime,$strreturnTime){
    //現在日時以降の日付か判定
    $nowTime = date("Y-m-d");
    if($nowTime <= $strborrowingTime && $strborrowingTime <= $strreturnTime){
      return true;
    }
    return false;
  }
      /**
     * 備品貸出予約情報をデータベースに書き込む
     *
     *
     */
    public function reservationRequest($getid,$getborrowing_time,$getreturn_time,$getapplication_remarks)
    {
      // 予約テーブルに追加
      // 最新の申請番号を取得して次の申請番号を連番で作る
      $applicationId = ReservationRequestDao::getDaoApplicationId();
      $setId = ++reset($applicationId)['application_id'];
        //session_start();
        //$_SESSION['email'] = 'b7143@oic.jp';
      ReservationRequestDao::setDaoApplication($setId,$_SESSION['email'],$getborrowing_time,$getreturn_time,$getapplication_remarks);

      // 明細テーブルに追加
      // 最新の申請明細番号を取得して次の申請明細番号を連番で作る(一件登録のみ)
      $detailId = ReservationRequestDao::getDaoDetailId();
      $setDetailId = ++reset($detailId)['application_detail_id'];

      ReservationRequestDao::setDaoAppDetail($setId,$setDetailId,$getid);
      return true;
    }

    /**
     * プロパティをセットする
     * @param array $arrDao
     * @return \EquipmentSystem\model\AdminUserModel
     */
    private function setProperty(array $arrDao)
    {
        $this->setEquipmentId($arrDao['equipment_id'])
            ->setEquipmentName($arrDao['equipment_name'])
            ->setHoldingQuantity($arrDao['holding_quantity'])
            ->setEquipmentDeletionFlag($arrDao['equipment_deletion_flag']);
        return $this;
    }

  // setter
  public function setEquipmentId($equipmentid){
    $this->_equipment_id = $equipmentid;
    return $this;
  }

  public function setEquipmentName($equipmentname){
    $this->_equipment_name = $equipmentname;
    return $this;
  }

  public function setHoldingQuantity($holdingquantity){
    $this->_holding_quantity = $holdingquantity;
    return $this;
  }

  public function setEquipmentDeletionFlag($equipmentdeleteflag){
    $this->_equipment_delete_flag = $equipmentdeleteflag;
    return $this;
  }

  // getter
  public function getEquipmentId(){
    return $this->_equipment_id;
  }

  public function getEquipmentName(){
    return $this->_equipment_name;
  }

  public function getHoldingQuantity(){
    return $this->_holding_quantity;
  }

  public function getEquipmentDeletionFlag(){
    return $this->_equipment_delete_flag;
  }

}