<?php
namespace myapp;

require_once '../include/conf/common.php';
    session_start();
    $getname = $_SESSION['name']; //id複数
    $getborrowing_time = filter_input(INPUT_POST,'borrowingTime');
    $getreturn_time = filter_input(INPUT_POST,'returnTime');
    $getapplication_remarks = filter_input(INPUT_POST,'applicationRemarks');
//include_once '../include/view/top.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>予約完了 - 備品申請システム</title>
    </head>
    <body>
        <form id ="success">
            <p>以下の内容で予約を受け付けました</p>
            <p>貸出備品:<?=$getname?></p>
            <p>貸出期間:<?=$getborrowing_time?></p>
            <p>返却日時:<?=$getreturn_time?></p>
            <p>備考:<?=$getapplication_remarks?></p>
            <input type="button" onclick="location.href='../../htdocs/userPage.php'" value="ユーザー画面へ"></input>
        </form>
    </body>
</html>