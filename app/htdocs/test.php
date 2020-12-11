<?php
  $dsn = 'mysql:host=localhost;dbname=equipmentsystem;charset=utf8';
  $user = 'test';
  $pass ='oicoic13';
  $dbh = new PDO($dsn,$user,$pass);


    $sql ='SELECT * FROM equipmentmaster';
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    include_once '../include/view/test.php';
