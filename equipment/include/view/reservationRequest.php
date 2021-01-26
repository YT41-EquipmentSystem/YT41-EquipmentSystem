<?php
namespace myapp\view;

require_once '../include/conf/common.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>備品申請予約画面</title>
    <link rel="stylesheet" type="text/css" href="../include/view/css/request.css">
  </head>
  <body>
    <form action="" method="post">
    <div class="baseform">
      <div class="title">
        <label class="title_txt">備品申請</label>
      </div>
  <!-- エラーメッセージ -->
  <?php
    if(!isset($_SESSION['errorR'])){
      //$_SESSION['error'] = "";
    }elseif($_SESSION['errorR'] != ""){
      $i = $_SESSION['errorR'];
      echo '<div class="errormessage">'.
           '<img class="errormessage-icon" src="../icon/admin_login_warning.svg" alt="" width="32" height="32">'.
           '<p class="errormessage-txt" name="errormessage" id="errormessage">'.$i.'</p>'.
           '</div>';
    }
    
  ?>
      <div class="wrapp">

        <div id="rentaladd">
          <div id="rental">
            <label class="text">貸出備品：</label>
            <input class="rental_txtbox" type="text" name="equipmentname" value="<?=$_SESSION['name']?>" readonly>
          </div>
        
        <div class="period">
          <label class="text">貸出期間：</label><input class="carendar" type="date" id="borrowingTime" name="borrowingTime" min="2020-01-01" max="2099-12-31">
        </div>

        <div class="returndate">
          <label class="text">返却日時：</label><input class="carendar" type="date" id="returnTime" name="returnTime" min="2020-01-01" max="2099-12-31">
        </div>

        <div class="column">
          <label class="text">備考</label>
          <textarea class="remarks" id="applicationRemarks" name="applicationRemarks" rows="5" cols="100"></textarea>
        </div>

        <button class="cancel_btn" type="submit" name="cancel">キャンセル</button>
        <button class="request_btn" type="submint" name="request">申請</button>
      </div>
      </div>
            </div>
      </form>
  </body>
</html>
