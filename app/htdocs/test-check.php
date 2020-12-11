<?php
  $button = key($_POST['submit']);
  $id = "equipment_id".$button;
  $name = "equipment_name".$button;
  $count = "equipment_count".$button;

  $id = $_POST[$id];
  $name = $_POST[$name];
  $count = $_POST[$count];

  session_start();
  $_SESSION['name'] = $name;
  header('Location: ./request.php');
