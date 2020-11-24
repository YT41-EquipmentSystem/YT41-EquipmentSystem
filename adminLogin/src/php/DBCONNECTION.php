<?php
//======================
// db接続クラス
//======================

class DbConnection {
    //====================
    // DBの接続方法の取得
    //====================
    public static function dbconnect() {
        $pdo = new PDO(
            'mysql:dbname=equipmentsystem;host=localhost;charset=utf8mb4',
            'test',
            'test',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
        return $pdo;
    }
}


?>