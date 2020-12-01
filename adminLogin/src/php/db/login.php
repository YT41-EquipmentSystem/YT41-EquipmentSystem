<?php
// ログイン画面で入力したメールアドレスとパスワードを取得
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = isset($_POST['pass']) ? $_POST['pass'] : null;

try {

    if(!preg_match("/^[a-zA-Z0-9@.]+$/" , $mail)){
        exit('2');
    }

    // サニタイジング(XSS対策)
    htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
    htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    // データベースに接続
    $pdo = new PDO(
        'mysql:dbname=equipmentsystem;host=localhost;charset=utf8mb4',
        'test',
        'test',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    $stmt = $pdo->prepare('SELECT count(*) FROM administrator WHERE id = :id AND password = :password');
    $stmt->bindValue(':id', $mail);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    while (false !== $value = $stmt->fetchColumn()) {
        if($value == 1){
            $_SESSION['EMAIL'] = $mail;
        }
        echo $value;
    }

} catch (PDOException $e) {
    // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}

?>