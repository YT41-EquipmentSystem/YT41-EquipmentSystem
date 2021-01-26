<?php
// まだできていないもの
try {

    // メールアドレスが英数文字,[@],[.]のみであるか確認
    Regexp::mailcheck($getmail);

    // サニタイジング(XSS対策)
    $mail = xss($getmail);
    $password = xss($getpassword);


} catch (PDOException $e) {
    
    // DBエラー時は管理者ログイン画面にリダイレクト
    header('Location: ./adminLogin.php',true, 307);

} catch (Exception $e){
    $errormessage = adminLoginCheck::checkLoginCount();
    if(isset($errormessage)){
        ErrorMessage::setErrorMessage($errormessage);
    }else{
        ErrorMessage::setErrorMessage($e->getMessage());
    }
    header('Location: ./adminLogin.php');
}

