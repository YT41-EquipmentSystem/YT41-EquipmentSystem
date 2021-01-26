<?php
namespace myapp\model;

class Session {
  public static function Check($status){
    switch ($status) {
      case 'start':
        Session::start();
        break;
      case 'destroy':
        Session::destroy();
      default:
        break;
    }
  }

  private static function start(){
    if(!isset($_SESSION)){
      session_start();
    }
  }

  private static function destroy(){
    // セッション変数を全て解除する
    $_SESSION = array();
    // セッションを切断するにはセッションクッキーも削除する。
    // セッション情報だけでなくセッションを破壊する。
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // 最終的に、セッションを破壊する
    session_destroy();
  }
}

class Regexp {
  /**
  *  メールアドレスが正しい表現がチェックする
  *  正しい場合はtrue、問題がある場合はfalseを返す
  *
  *  @param  String $mail
  *  @return bool
  */
  public static function mailCheck($mail){
    if(!preg_match("/^[a-zA-Z0-9@.]+$/" , $mail)){
        return TRUE;
    } else {
        return FALSE;
    }
  }
}

/**
*  文字列をサニタイジングする
*
*  @param String $data
*  @return String
*/
function xss($data){
  $str = '';
  $str = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  return $str;
}

class HttpRequest{
  /** 
  *  HttpRequestのPostデータ取得を行う
  *  何も入っていない場合は、そのまま返す
  *  
  *  @param  String $key
  *  @return String
  */
  public static function getPostData($key){
    $str = '';

    if(isset($_POST[$key]) === TRUE){
      $str = $_POST[$key];
    }

    return $str;
  }
}

// エラーメッセージを取得・設定するクラス
class ErrorMessage{
  /**
  *  エラーメッセージを取得する
  *  何も入っていない場合は、そのまま返す
  *  すでにエラーメッセージが表示されている場合もそのまま返す
  *  @return String
  */
  public static function getErrorMessage(){
    $str = '';
    Session::Check('start');
    if(isset($_SESSION['errormessage'][0]) && $_SESSION['errormessage'][1] === 0){
      $str = $_SESSION['errormessage'][0];
      $_SESSION['errormessage'][1] = 1;
    }
    return $str;
  }

  /**
  *  エラーメッセージを設定する
  *
  *  @param  String $data
  *  @return String
  */
  public static function setErrorMessage($data){
    Session::Check('start');
    $_SESSION['errormessage'] = array($data,0);
  }
}



/**
 * 管理者ログイン画面のクラス
 */
class adminLoginCheck
{

    /**
     * アカウントをロックするログイン失敗回数
     */
    const LOCK_COUNT = 3;

    /**
     * アカウントをロックする時間（分）
     */
    const LOCK_MINUTE = '+15minute';

    private static function setLoginCount(){
      $_SESSION['logincount'] = 1;
    }
    
    public static function checkLoginCount(){
      Session::Check('start');
      //\Session::Check('destroy');
      if(!isset($_SESSION['logincount'])){
        adminLoginCheck::setLoginCount();
      }elseif(++$_SESSION['logincount'] == adminLoginCheck::LOCK_COUNT){
          // 現在時刻からロックが解除される時間を保存する
          // 日本時間に合わせる
          date_default_timezone_set('Asia/Tokyo');
          $_SESSION['loginNowtime'] = date("Y/m/d H:i:s", strtotime(adminLoginCheck::LOCK_MINUTE));
        }
      // ログイン失敗回数が3回に到達した場合、ロック時間の間ログインできないようにする
      if(isset($_SESSION['loginNowtime'])){
        date_default_timezone_set('Asia/Tokyo');
        if($_SESSION['loginNowtime'] > date("Y/m/d H:i:s")){
          $massage = 'ログインに3回失敗しました。しばらくおまちください。';
          return $massage;
        }else{
          //ロック解除時に失敗回数とロック時間の初期化
          unset($_SESSION["logincount"]);
          unset($_SESSION["loginNowtime"]);
        }
      }

    }
}



