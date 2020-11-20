<?php
//=========================
// トークン情報生成・確認クラス
//=========================
class CsrfValidator {

    const HASH_ALGO = 'sha256';

    //================================
    // トークン生成処理
    // ===============================
    public static function generate()
    {
        // PHP_SESSION_NONE セッションが有効だけれどもセッションが存在しない場合
        if (session_status() === PHP_SESSION_NONE) {
            throw new \BadMethodCallException('Session is not active.');
        }
        // sessionIDを元にSHA256でハッシュ値を生成
        return  hash(self::HASH_ALGO, session_id());
    }

    //=================================
    // トークンチェック処理
    //=================================
    public static function validate($token, $throw = false)
    {
        $success = self::generate() === $token;
        if (!$success && $throw) {
            throw new \RuntimeException('CSRF validation failed.', 400);
        }
        return $success;
    }

}
?>