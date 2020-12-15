<?php

    // 設定ファイル読み込み
require_once '../include/conf/const.php';
// 共通関数ファイルfunction.php読み込み
require_once '../include/model/function.php';
// db接続用クラス読み込み
require_once '../include/model/dbconnection.php';

// ログイン画面で入力したメールアドレスとパスワードを取得
$getmail = HttpRequest::getPostData('mail');
$getpassword = HttpRequest::getPostData('pass');

try {

    // メールアドレスが英数文字,[@],[.]のみであるか確認
    Regexp::mailcheck($getmail);

    // サニタイジング(XSS対策)
    $mail = xss($getmail);
    $password = xss($getpassword);

    // メールアドレスに一致するデータを取得(パスワードはハッシュ化されているため後でチェックする)
    $sql  = 'SELECT *';
    $sql .= ' FROM administrator';
    $sql .= ' WHERE id = :id';

    // バインドデータを配列で設定
    $bindListName = array(":id");
    $bindListData = array($mail);

    // カラム名をキーとする連想配列で取得
    $id = DbConnection::getSelectDbConnectionBind($sql,$bindListName,$bindListData,1);

    // idチェック
    if(!$id){
        throw new Exception('ユーザ名が正しくありません。');
    }

    //パスワードチェック
    if(!password_verify($password, $id['password'])){
        throw new Exception('パスワードが正しくありません。');
    }

    // 更新の必要があるかチェック
    if(password_needs_rehash($id['password'], PASSWORD_ARGON2I)){
        // hashアルゴリズムが古い場合に更新する
        $sql = 'UPDATE administrator SET password = :password WHERE name = :name';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $mail);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_ARGON2I));
        $stmt->execute();
    }
    // CSLF対策のトークンをtopへ引き継いでリダイレクト
    header('Location: ./top.php', true, 307);
} catch (PDOException $e) {
    // DBエラー時は管理者ログイン画面にリダイレクト
    header('Location: ./adminLogin.php',true, 307);
    
} catch (Exception $e){

    ErrorMessage::setErrorMessage($e->getMessage());
    header('Location: ./adminLogin.php');
}

