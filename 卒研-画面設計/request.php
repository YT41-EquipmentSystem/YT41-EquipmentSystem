<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="css/request.css">
</head>
<body></div>
  	<form action="confirm.php" method="post" name="form" onsubmit="return validate()">
  <div class="mozi1">

  貸出備品
  </div>
  <div class="mozi2">
      貸出期間
  </div>
  <div class="mozi3">
    備考
  </div>

  <div class="wrapp">
  <div class="fixtures1">
    備品1</div>
    <div class="fixtures2">
      備品2
    </div>
    <div class="fixtures2">
      備品3
  </div>


  <input type="date" id="start" name="trip-start"
       value="2020-11-13"
       min="2020-01-01" max="2021-12-31">

				<textarea name="content" rows="5" ></textarea>

       <button type="button" name="cancelbutton">キャンセル</button>
       <button type="submit" name="cancelbutton">申請</button>
</body>
</html>
