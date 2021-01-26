<?php
namespace myapp\controller;

use \myapp\model\AdminUserModel;
use \myapp\conf\Db;
use \myapp\conf\InvalidErrorException;
use \myapp\conf\ExceptionCode;


class AdminLoginController{

  // ログイン成功時の遷移先
  const TARGET_PAGE = '../../htdocs/top.php';

  // エラー時
  const PAGE = '../../htdocs/adminlogin.php';
  /**
   * メールアドレス(id)とパスワードでログインする
   * @return void
   */
  static public function login(){
    // POSTされていない時は、処理を中断
    if(!filter_input_array(INPUT_POST)){
      return;
    }

    try{
    // 管理者ログイン画面のメールアドレスとパスワードを取得
    $getmail = filter_input(INPUT_POST,'inputEmail');
    $getpassword = filter_input(INPUT_POST,'inputPassword');
    // 空白チェック
    if ('' == $getmail || '' == $getpassword){
      return;
    }

    // トランザクションを開始
    Db::transaction();

    // メールアドレスからユーザーモデルを取得
    $objAdminUserModel = new AdminUserModel();
    $objAdminUserModel->getModelById($getmail);
    


    // ロックされているアカウントかチェック
    if ($objAdminUserModel->isAccountLock()){
      Db::commit();
      // ロックされている場合はエラーを吐く
      throw new InvalidErrorException(ExceptionCode::INVALID_LOCK);
    }


    // パスワードチェック
    if(!$objAdminUserModel->checkPassword($getpassword)){
      // ログイン失敗
      $objAdminUserModel->loginFailureIncrement();
      Db::commit();
      throw new InvalidErrorException(ExceptionCode::INVALID_LOGIN_FAIL);
    }
    $objAdminUserModel->passwordUpdate($getpassword);

    // ログイン失敗をリセット
    $objAdminUserModel->loginFailureReset();

    // コミット
    Db::commit();

    // セッション固定攻撃対策
    session_regenerate_id(true);

    //ページ遷移
    header(sprintf("location: %s", self::TARGET_PAGE), true, 307);
    
      }catch(InvalidErrorException $e){
      $_SESSION['error'] = $e->getMessage();
      //exit();
    }
  }
}