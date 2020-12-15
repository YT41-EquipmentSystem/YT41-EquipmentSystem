<?php
// データベース処理クラス
class DbConnection {
  /**
  *  データベース接続情報を取得する
  *
  *   @return array $pdo
  */
  private static function getPdodata() {
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

  /**
  *  WHERE句(バインド)があるSELECT文の結果を取得する
  *
  *  @param String $sqlString
  *  @param array  $bindListName
  *  @param array  $bindListData
  *  @param int    $bindListCount
  *  @return array
  */

  public static function getSelectDbConnectionBind($sqlString,$bindListName,$bindListData,$bindListCount){
    $date = '';
    try {
      $pdo = DbConnection::getPdodata();
      $stmt = $pdo->prepare($sqlString);
      for($i = 0; $i < $bindListCount; $i++){
        $stmt->bindValue($bindListName[$i], $bindListData[$i]);
      }
      $stmt->execute();
      // カラム名をキーとする連想配列で取得
      $date = $stmt->fetch(PDO::FETCH_ASSOC);
      return $date;
    } catch(PDOException $e) {
      return $date;
    }
  }
}