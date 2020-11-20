<?php
//================
//
//================
require_once('../../../adminLogin.php');
require_once('../DBCONNECTION.php');

// ログイン画面で入力したメールアドレスとパスワードを取得
$mail = $_POST['mail'];//filter_input(INPUT_POST, mail, FILTER_VALIDATE_EMAIL);
$password = $_POST['pass'];//filter_input(INPUT_POST, password, FILTER_VALIDATE_EMAIL);

try {
    // データベースに接続
    $pdo = DbConnection::dbconnect();

    // メールアドレスが英数文字,[@],[.]のみであるか確認
    if(!preg_match("/^[a-zA-Z0-9@.]+$/" , $mail)){
        exit;// catchさせるべき
    }

    // サニタイジング(XSS対策)
    htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
    htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    // メールアドレスに一致するデータを取得(パスワードはハッシュ化されているため後でチェックする)
    $sql  = 'SELECT *';
    $sql .= ' FROM administrator';
    $sql .= ' WHERE id = :id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $mail);
    $stmt->execute();

    // カラム名をキーとする連想配列で取得
    $id = $stmt->fetch(PDO::FETCH_ASSOC);
    // idチェック
    if(!$id){
        echo 'ユーザ名かパスワードが正しくありません。';// 出力場所を選ぶべき
        exit;//catchさせるべき
    }

    //パスワードチェック
    if(!password_verify($password, $id['password'])){
        echo 'ユーザ名かパスワードが正しくありません。';// 出力場所を選ぶべき
        exit;//catchさせるべき
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

    // ログイン成功情報を保存
    $_SESSION['login'] = true;

    // CSLF対策のトークンをtopへ引き継いでリダイレクト
    header('Location: ../../../top.php', true, 307);

} catch (PDOException $e) {
    // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

?>