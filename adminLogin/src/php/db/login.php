<?php
$id = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = isset($_POST['pass']) ? $_POST['pass'] : null;

try {

    /* リクエストから得たスーパーグローバル変数をチェックするなどの処理 */

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

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    $stmt = $pdo->prepare('SELECT count(*) FROM administrator WHERE id = :id AND password = :password');
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    while (false !== $value = $stmt->fetchColumn()) {
        echo $value;
    }

} catch (PDOException $e) {
    // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
?>