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
// データベース接続に必要な定数定義
define('DSN', 'mysql:host=localhost;dbname=equipmentsystem;charset=utf8');
define('USER', 'test');
define('PASSWORD', 'test');

// データベースに接続失敗すると例外が発生するので、try、catchで囲む
try {
  // データベース接続
  $pdo = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $e) {
  // エラーメッセージ表示
  echo "データベース接続失敗：" . $e->getMessage();
  echo '<br>';
  // 処理終了
  exit();
}
?>
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
                            <p class="lead">
                                <?php
                                if($row['holding_quantity'] == 0){
                                    echo "貸出不可";
                                }else{
                                    echo "貸出可能";
                                }
                                ?>
                                </p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-success" href="http://www.jquery2dotnet.com">申請する</a>
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

?></p>
                    
        
    </div>
</div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script><script  src="js\itiran.js"></script>

</body>
</html>
