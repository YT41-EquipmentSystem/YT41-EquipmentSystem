<?php
namespace myapp\dao;

use myapp\conf\Db;
use myapp\model\ReservationRequestModel;

/**
 * ReservationRequestDao.php
 */
class ReservationRequestDao
{
  /**
   * 備品IDから配列を取得する
   * @param type $intEquipmentId
   * @return array
   */
   public static function getDaoFromEquipmentId($intEquipmentId, $intEquipmentDeletionFlag = null)
   {
      $sql = "SELECT ";
      $sql .= "`equipment_id`";
      $sql .= ", `equipment_name`";
      $sql .= ", `holding_quantity`";
      $sql .= ", `equipment_deletion_flag` ";
      $sql .= "FROM `t_equipment` ";
      $sql .= "WHERE `equipment_id` = :equipment_id ";
      
        $arr = array();
        $arr[':equipment_id'] = $intEquipmentId;
        if (!is_null($intEquipmentDeletionFlag) && in_array($intEquipmentDeletionFlag, array(0, 1))) {
            $sql .= "AND `equipment_deletion_flag` = :equipment_deletion_flag ";
            $arr[':equipment_deletion_flag'] = $intEquipmentDeletionFlag;
        }
        return Db::select($sql, $arr);

   }

     public static function userdb($email){
 // 申請時刻、貸出日、返却日、状態、備品名
  $sql = "SELECT ";
  $sql .= "t_a.application_time, t_a.borrowing_time, t_a.return_time, t_a.application_remarks, t_a.application_status, ";
  $sql .= "t_e.equipment_name ";
  $sql .= "from t_application t_a join t_application_detail t_ad on t_a.application_id = t_ad.application_id ";
  $sql .= "join t_equipment t_e on t_ad.equipment_id = t_e.equipment_id ";
  $sql .= "WHERE t_a.student_id = :student_id ";
  $sql .= "ORDER BY t_a.boorowing_time DESC";

  $arr = array();
  $arr[':student_id'] = $email;
  return Db::select($sql, $arr);
}


   // 貸出日時と備品IDから件数を取得する
  public static function getDaoFromColumnCount($intBorrowingTime, $intEquipmentId, $intEquipmentDeletionFlag = null)
     {
        $sql = "SELECT ";
        $sql .= "count(*) ";
        $sql .= "FROM `t_application` AS T_A ";
        $sql .= "JOIN `t_application_detail` AS T_AD ";
        $sql .= "ON T_A.application_id = T_AD.application_id ";
        $sql .= "WHERE T_A.borrowing_time = :borrowing_time ";
        $sql .= "AND T_AD.equipment_id = :equipment_id ";
        $sql .= "AND T_A.application_status <> 3";

          $arr = array();
          $arr[':borrowing_time'] = $intBorrowingTime;
          $arr[':equipment_id'] = $intEquipmentId;

          return Db::select($sql, $arr);

     }

     // 最後の申請番号を取得する
     public static function getDaoApplicationId()
     {
      $sql = "SELECT ";
      $sql .= "application_id ";
      $sql .= "FROM `t_application` ";
      $sql .= "ORDER BY `application_id` DESC ";
      $sql .= "LIMIT 1";

      $arr = array();
      return Db::select($sql, $arr);
     }

      // 最後の申請明細番号を取得する
     public static function getDaoDetailId()
     {
      $sql = "SELECT ";
      $sql .= "application_detail_id ";
      $sql .= "FROM `t_application_detail` ";
      $sql .= "ORDER BY `application_detail_id` DESC ";
      $sql .= "LIMIT 1";

      $arr = array();
      return Db::select($sql, $arr);
     }

     // 新たな申請データを追加する
     public static function setDaoApplication($getapplication_id,$getstudent_id,$getborrowing_time,$getreturn_time,$getapplication_remarks)
     {
      $sql = "INSERT INTO ";
      $sql .= "t_application (application_id,student_id,borrowing_time,return_time,application_remarks) ";
      $sql .= "VALUES (:application_id,:student_id,:borrowing_time,:return_time,:application_remarks)";

      $arr = array();
      $arr[':application_id'] = $getapplication_id;
      $arr[':student_id'] = $getstudent_id;
      $arr[':borrowing_time'] = $getborrowing_time;
      $arr[':return_time'] = $getreturn_time;
      $arr[':application_remarks'] = $getapplication_remarks;

      return Db::insert($sql, $arr);
     }

      // 新たな申請明細データを追加する
     public static function setDaoAppDetail($getapplication_id,$getapplication_detail_id,$getequipment_id)
     {
      $sql = "INSERT INTO ";
      $sql .= "t_application_detail (application_id, application_detail_id,equipment_id) ";
      $sql .= "VALUES (:application_id, :application_detail_id, :equipment_id)";

      $arr = array();
      $arr[':application_id'] = $getapplication_id;
      $arr[':application_detail_id'] = $getapplication_detail_id;
      $arr[':equipment_id'] = $getequipment_id;

      return Db::insert($sql, $arr);
     }
}