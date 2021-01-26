<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="UTF-8">
  <title>備品一覧</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'><link rel="stylesheet" href="css\itiran_design.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>
<body>
<?php
require_once '../../include/conf/common.php';
session_start();
// データベース接続に必要な定数定義
    const DSN = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset='.DB_CHARSET.';';

    // 申請ボタン押下時に申請ページへ遷移
    if(filter_input_array(INPUT_POST)){
        // ボタンのvalueから選択した備品のデータを取得
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        $_SESSION['id'] = $_POST['id'.$_POST['a']];
        $_SESSION['name'] = $_POST['name'.$_POST['a']];

        header("location: ../reservationRequest.php");
        exit();
    }
// データベースに接続失敗すると例外が発生するので、try、catchで囲む
try {
  // データベース接続
  $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
  // エラーメッセージ表示
  echo "データベース接続失敗：" . $e->getMessage();
  echo '<br>';
  // 処理終了
  exit();
}
?>
<form method="post" action="">
<div class="container">
    <div class="well well-sm">
        <strong>Display</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div id="products" class="row list-group">

<?php
// 選択した備品の番号の変数
$i=1;

try{

    $sql = "select * from t_equipment ";
    //配列の数分ループ
    foreach ($pdo->query($sql) as $row) {
        ?>
        <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
                <img class="group list-group-image" src="<?php //備品の画像のパス
                        echo $row['equipment_img']; ?>" alt="" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                        <?php //備品名
                        echo $row['equipment_name']; ?></h4>
                    <p class="group inner list-group-item-text">
                    <?php //備品の説明文
                        echo $row['equipment_notes']; ?></p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="hidden" name="id<?=$i?>" id="id<?=$i?>" value="<?=$row['equipment_id']?>">
                            <input type="hidden" name="name<?=$i?>" id="name<?=$i?>" value="<?=$row['equipment_name']?>">
                            <button class="btn btn-success" type="submit" value="<?=$i++?>" name="a">申請する</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;
?>
</p>

    </div>
</div>
</form>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script><script  src="js\itiran.js"></script>

</body>
</html>



