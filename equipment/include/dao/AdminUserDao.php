<?php
namespace myapp\dao;

use myapp\conf\Db;
use myapp\model\AdminUserModel;

/**
 * AdminUserDao.php
 */
class AdminUserDao
{
    /**
     * ユーザーIDから配列を取得する
     * @param type $intUserId
     * @return array
     */
    public static function getDaoFromAdminUserId($intAdminUserId, $intDeleteFlag = null)
    {
        $sql = "SELECT ";
        $sql .= "`id`";
        $sql .= ", `password`";
        $sql .= ", `login_failure_count`";
        $sql .= ", `login_failure_time`";
        $sql .= ", `delete_flag` ";
        $sql .= "FROM `administrator` ";
        $sql .= "WHERE `id` = :id ";

        $arr = array();
        $arr[':id'] = $intAdminUserId;
        if (!is_null($intDeleteFlag) && in_array($intDeleteFlag, array(0, 1))) {
            $sql .= "AND `delete_flag` = :delete_flag ";
            $arr[':delete_flag'] = $intDeleteFlag;
        }

        return Db::select($sql, $arr);
    }

    /**
     * 更新する
     * @param AdminUserModel $objAdminUserModel
     * @return bool
     */
    public static function save(AdminUserModel $objAdminUserModel)
    {
        $sql = "UPDATE ";
        $sql .= "`administrator` ";
        $sql .= "SET ";
        $sql .= "`password` = :password ";
        $sql .= ", `login_failure_count` = :login_failure_count ";
        $sql .= ", `login_failure_time` = :login_failure_time ";
        $sql .= ", `delete_flag` = :delete_flag ";
        $sql .= "WHERE `id` = :id ";

        $arr = array();
        $arr[':id'] = $objAdminUserModel->getId();
        $arr[':password'] = $objAdminUserModel->getPassword();
        $arr[':login_failure_count'] = $objAdminUserModel->getLogin_failure_count();
        $arr[':login_failure_time'] = $objAdminUserModel->getLogin_failure_time();
        $arr[':delete_flag'] = $objAdminUserModel->getDelete_flag();

        return Db::update($sql, $arr);
    }

    /**
     * 新規作成する
     * @return int
     */
    public static function insert(UserModel $objUserModel)
    {
        $sql = "INSERT INTO ";
        $sql .= "`administrator` ";
        $sql .= "(";
        $sql .= "`id`";
        $sql .= ", `password`";
        $sql .= ", `login_failure_count`";
        $sql .= ", `login_failure_time`";
        $sql .= ", `delete_flag`";
        $sql .= ") VALUES (";
        $sql .= "NULL ";
        $sql .= ", :password ";
        $sql .= ", :login_failure_count ";
        $sql .= ", :login_failure_time ";
        $sql .= ", :delete_flag ";
        $sql .= ")";

        $arr = array();
        $arr[':password'] = $objUserModel->getPassword();
        $arr[':login_failure_count'] = $objUserModel->getLoginFailureCount();
        $arr[':login_failure_time'] = $objUserModel->getLoginFailureDatetime();
        $arr[':delete_flag'] = $objUserModel->getDeleteFlag();

        return Db::insert($sql, $arr);
    }

}