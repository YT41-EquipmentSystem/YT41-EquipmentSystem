<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../include/view/css/request.css">
  </head>
  <body>
    <div class="baseform">
      <div class="title">
        <label class="title_txt">備品申請</label>
      </div>

      <form method="post" action="../../htdocs/request-check.php">

      <div class="wrapp">
        <div id="rentaladd">
          <div id="rental">
            <label class="text">貸出備品：</label>
            <input class="rental_txtbox" type="text" name="equipmentname" value="<?=$_SESSION['name']?>" readonly>
          </div>
        </div>

        <div class="period">
          <label class="text">貸出期間：</label>
          <input class="carendar" type="date" id="start" name="trip-start"
            min="2020-01-01" max="2021-12-31">
        </div>

        <div class="returndate">
          <label class="text">返却日時：</label>
          <input class="carendar" type="date" id="start" name="trip-start"
            min="2020-01-01" max="2021-12-31">
        </div>

        <div class="column">
          <label class="text">備考</label>
          <textarea class="remarks" name="remarks" rows="5" cols="100"></textarea>
        </div>


        <button class="cancel_btn" type="button" name="cancel">キャンセル</button>
        <button class="request_btn" type="button" name="request">申請</button>

      </form>
      </div>
    </div>
  </body>
</html>
