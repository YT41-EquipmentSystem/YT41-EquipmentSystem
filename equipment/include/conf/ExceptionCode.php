<?php

namespace myapp\conf;

class ExceptionCode
{
    //エラーコードを整数で定義する
    const INVALID_ERR = 1000;
    const INVALID_LOCK = 1001;
    const INVALID_LOGIN_FAIL = 1002;
    const INVALREQUEST_RESERVATION_MAX = 1011;
    const INVALREQUEST_DATE = 1012;
    const APPLICATION_ERR = 2000;
    const SYSTEM_ERR = 3000;
    const TEMPLATE_ERR = 3001;

    private static $_arrMessage = array(
        self::INVALID_ERR => 'エラーが発生しました。'
        , self::INVALID_LOCK => 'アカウントがロックされています。'
        , self::INVALID_LOGIN_FAIL => 'ログインに失敗しました。'
        , self::INVALREQUEST_RESERVATION_MAX => '予約数がいっぱいです。'
        , self::INVALREQUEST_DATE => '日時が不正な値です。'
        , self::APPLICATION_ERR => 'アプリケーション・エラーが発生しました。'
        , self::SYSTEM_ERR => 'システム・エラーが発生しました。'
        , self::TEMPLATE_ERR => 'テンプレート[%s]が見つかりません。'
    );

    static public function getMessage($intCode)
    {
        if (array_key_exists($intCode, self::$_arrMessage)) {
            return self::$_arrMessage[$intCode];
        }
    }
}