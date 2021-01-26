<?php

namespace myapp\model;

use myapp\dao\AdminUserDao;

/**
 * 管理者モデル
 */
final class AdminUserModel
{
    // ロックするログイン失敗回数
    const LOCK_COUNT = 3;
    // ロックする時間(分)
    const LOCK_MINUTE = 30;
    private $_id = null;
    private $_password = null;
    private $_login_failure_count = null;
    private $_login_failure_time = null;
    private $_delete_flag = null;

    /**
     * メールアドレス(id)からユーザーを検索する
     * @param string $strId
     * @return \Equipment\model\AdminUserModel
     */
    public function getModelById($strId)
    {
        $dao = AdminUserDao::getDaoFromAdminUserId($strId);
        return (isset($dao[0])) ? $this->setProperty(reset($dao)) : null;
    }

    /**
     * パスワードが一致しているかどうかを判定する
     * @param type $password
     * @return bool
     */
    public function checkPassword($password)
    {
        $hash = $this->getPassword();
        return password_verify($password, $hash);
    }
    /**
     * パスワードの変更が必要かチェックする
     *
     */
    public function passwordUpdate($password){
      $hash = $this->getPassword();
      // 更新の必要があるかチェック
      if(password_needs_rehash($hash, PASSWORD_ARGON2I)){
        // hashアルゴリズムが古い場合に更新する
        $this->setPassword(password_hash($password, PASSWORD_ARGON2I));
        return $this->save();
      }
      return true;
    }

    /**
     * ログイン失敗をリセットする
     * １以上のときに０にする
     * @return bool
     */
    public function loginFailureReset()
    {
        $count = $this->getLogin_failure_count();
        if (0 < $count) {
            $this->setLogin_failure_count(0)
                ->setLogin_failure_time(null);
            return $this->save();
        }

        return true;
    }

    /**
     * ログイン失敗をインクリメントする
     * 指定回数（self::LOCK_COUNT）に満たないときのみ＋１
     * @return bool
     */
    public function loginFailureIncrement()
    {
        $count = $this->getLogin_failure_count();
        if (self::LOCK_COUNT > $count) {
            $now = (new \DateTime())->format('Y-m-d H:i:s');
            $this->setLogin_failure_count(1 + $count)
                ->setLogin_failure_time($now);
            return $this->save();
        }

        //ログイン失敗が設定以上のとき
        return true;
    }

    /**
     * アカウントがロックされているかどうかを判定する
     * @return bool ロックされていたら true
     */
    public function isAccountLock()
    {
        $count = $this->getLogin_failure_count();
        $datetime = $this->getLogin_failure_time();

        $lastFailureDatetime = new \DateTime($datetime);
        $interval = new \DateInterval(
            sprintf('PT%dM', self::LOCK_MINUTE)
        );
        $lastFailureDatetime->add($interval);

        //設定時間以内で、かつ設定回数以上の失敗を記録しているとき
        if ($lastFailureDatetime > new \DateTime() && self::LOCK_COUNT <= $count) {
            return true;
        }
        return false;
    }

    /**
     * プロパティをセットする
     * @param array $arrDao
     * @return \EquipmentSystem\model\AdminUserModel
     */
    private function setProperty(array $arrDao)
    {
        $this->setId($arrDao['id'])
            ->setPassword($arrDao['password'])
            ->setLogin_failure_count($arrDao['login_failure_count'])
            ->setLogin_failure_time($arrDao['login_failure_time'])
            ->setDelete_flag($arrDao['delete_flag']);
        return $this;
    }

    /**
     * 更新する
     * @return bool
     */
    public function save()
    {
        return AdminUserDao::save($this);
    }

        /**
     * 新規作成する
     * @return bool
     */
    public function create()
    {
        return AdminUserDao::insert($this);
    }


// setter
public function setId($id){
  $this->_id = $id;
  return $this;
}

public function setPassword($password){
  $this->_password = $password;
  return $this;
}

public function setLogin_failure_count($login_failure_count){
  $this->_login_failure_count = $login_failure_count;
  return $this;
}

public function setLogin_failure_time($login_failure_time){
  $this->_login_failure_time = $login_failure_time;
  return $this;
}

public function setDelete_flag($delete_flag){
  $this->_delete_flag = $delete_flag;
  return $this;
}

// getter
public function getId(){
  return $this->_id;
}

public function getPassword(){
  return $this->_password;
}

public function getLogin_failure_count(){
  return $this->_login_failure_count;
}

public function getLogin_failure_time(){
  return $this->_login_failure_time;
}

public function getDelete_flag(){
  return $this->_delete_flag;
}

}
