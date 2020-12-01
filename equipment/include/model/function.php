<?php
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
  *
  *  @return String
  */
  public static function getErrorMessage(){
    $str = '';
    if(isset($_SESSION['errormessage'])){
      $str = $_SESSION['errormessage'];
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
    $_SESSION['errormessage'] = $data;
  }
}




