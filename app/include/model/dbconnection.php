<?php
// データベース処理クラス
class DbConnection {
  /**
  *  データベース接続情報を取得する
  *
  *   @return array $pdo
  */
  public static function getPdodata() {
      $pdo = new PDO(
          'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset='.DB_CHARSET,
          DB_USER,
          DB_PASSWORD,
          [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          ]
      );
      return $pdo;
  }
}