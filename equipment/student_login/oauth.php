<?php
// GoogleOauthの設定でstudent_login下に読み込むようになっているため、oauth.phpだけ別ファイル

  // 設定ファイル読み込み
  require_once '../include/conf/common.php';
session_start();


$params = array(
	'code' => $_GET['code'],
	'grant_type' => 'authorization_code',
	'redirect_uri' => CALLBACK_URL,
	'client_id' => CONSUMER_KEY,
	'client_secret' => CONSUMER_SECRET,
);

$header = array(
    "Content-Type: application/x-www-form-urlencoded"
    );

// POST送信
$options = array('http' => array(
    'method' => 'POST',
    'header' => implode($header),
	'content' => http_build_query($params)
));



// アクセストークンの取得
$res = file_get_contents(TOKEN_URL, false, stream_context_create($options));

// レスポンス取得
$token = json_decode($res, true);
if(isset($token['error'])){
	echo 'エラー発生';
	exit;
}else{
	//ログインセッション
	$_SESSION['login'] = true;
}

$access_token = $token['access_token'];

$params = array('access_token' => $access_token);

// ユーザー情報取得
$res = file_get_contents(INFO_URL . '?' . http_build_query($params));

$result = json_decode($res, true);

$_SESSION['email'] = $result['email'];
$_SESSION['family_name'] = $result['family_name'];
$_SESSION['given_name'] = $result['given_name'];
header("location: ../htdocs/userPage.php");
exit();
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>GoogleのOAuth2.0を使ってプロフィールを取得</title>
</head>
<body>
	<h2>ユーザー情報</h2>
	<table>
		<tr><td>ID</td><td><?php echo $result['id']; ?></td></tr>
		<tr><td>ユーザー名</td><td><?php echo $result['name']; ?></td></tr>
		<tr><td>苗字</td><td><?php echo $result['family_name']; ?></td></tr>
		<tr><td>名前</td><td><?php echo $result['given_name']; ?></td></tr>
		<tr><td>場所</td><td><?php echo $result['locale']; ?></td></tr>
		<tr><td>メールアドレス</td><td><?php echo $result['email']; ?></td></tr>
		<tr><td>ログイン状態</td><td><?php echo $_SESSION['login']; ?></td></tr>
	</table>
	<h2>プロフィール画像</h2>
	<img src="<?php echo $result['picture']; ?>" width="100">
	 <input type="button" onclick="location.href='../htdocs/itiran_gamen/gamen.php'" value="備品一覧画面へ">
</body>
</html>