<?php

namespace myapp\model;

// トークン情報生成・確認クラス
final class CsrfValidator {
    const HASH_ALGO = 'sha256';
    /**
    *  トークンを生成する
    *  エラーの場合は、throwする
    *
    *  @return String $hash
    */
    public static function generate()
    {
        $hash = '';
        // PHP_SESSION_NONE セッションが有効だけれどもセッションが存在しない場合
        if (session_status() === PHP_SESSION_NONE) {
           throw new \BadMethodCallException('Session is not active.');
        }
        // sessionIDを元にSHA256でハッシュ値を生成
        $hash = hash(self::HASH_ALGO, session_id());
        return  $hash;
    }

    /**
    *  トークン情報を確認する
    *  エラーの場合は、throwする
    *
    *  @param  String $token
    *  @param  bool   $throw
    *  @return String $success
    */
    public static function validate($token, $throw = false)
    {
        $success = self::generate() === $token;
        if (!$success && $throw) {
              throw new \RuntimeException('CSRF validation failed.', 400);
        }
        return $success;
    }
}