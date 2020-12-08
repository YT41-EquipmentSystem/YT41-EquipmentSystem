  <!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />

    </head>
    <body>
      <table>
     <tr>
      <th>No</th>
      <th>備品</th>
      <th>在庫数</th>
    </tr>
      <form method="post" action="../../htdocs/request-check.php">
        <?php $i = 0 ?>


    <?php foreach($result as $column): ?>
    <tr>
      <?php $i++ ?>
      <?php $column1 =  $column['equipment_id']?>
      <td><input name="equipment_id<?=$i?>" type="text" value="<?=$column['equipment_id']?>"></td>
      <?php $column2 =  $column['equipment_name']?>
      <td> <input name="equipment_name<?=$i?>" type="text" value="<?=$column['equipment_name']?>"></td> </td>
      <?php $column3 =  $column['borrowing_max_count']?>
      <td> <input name="equipment_count<?=$i?>" type="text" value="<?=$column['borrowing_max_count']?>"> </td>
      <td><input name ="submit[<?=$i?>]" type="submit" value="申請"></input></td>
    </tr>
    <?php endforeach; ?>
  </table>
  </form>
</body>
</html>
