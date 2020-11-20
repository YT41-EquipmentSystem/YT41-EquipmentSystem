<?php
	// フォームのボタンが押されたら
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームから送信されたデータを各変数に格納

		$trip = $_POST["trip-start"];
		$content  = $_POST["content"];
	}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>確認画面</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div>
	<form action="confirm.php" method="post" onsubmit="return validate()">>
            <input type="hidden" name="item" value="<?php echo $trip; ?>">
            <input type="hidden" name="content" value="<?php echo $content; ?>">
            <h1 class="contact-title"> 内容確認</h1>
            <p>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                <div>
                    <label>貸出期間</label>
                    <p><?php echo $trip; ?></p>
                </div>
                <div>
                    <label>備考</label>
                    <p><?php echo nl2br($content); ?></p>
                </div>
            </div>
		<input type="button" value="内容を修正する" onclick="history.back(-1)">
		<button type="submit" onclick="location.href='Complete.php'">送信する</button>
	</form>
</div>
</body>
</html>
