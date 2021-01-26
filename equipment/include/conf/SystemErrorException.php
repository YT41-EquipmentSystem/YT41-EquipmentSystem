<?php

namespace myapp\conf;

class SystemErrorException extends \Exception
{

    /**
     * コンストラクタ
     * @param type $code
     * @param \Exception $previous
     */
    public function __construct($code, \Exception $previous = null)
    {
        $message = ExceptionCode::getMessage($code);
        self::writeLog($message);
        self::sendMail($message);
        parent::__construct('システムエラーが発生しました。', $code, $previous);
    }

    /**
     * 管理者へメール
     * @param type $message
     */
    static private function sendMail($message)
    {

    }

    /**
     * ログを書く
     * @param type $message
     */
    static private function writeLog($message)
    {

    }

}
