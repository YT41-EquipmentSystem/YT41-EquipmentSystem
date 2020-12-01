// 文字列をsha256変換する
async function sha256(str) {
   // Convert string to ArrayBuffer
   const buff = new Uint8Array([].map.call(str, (c) => c.charCodeAt(0))).buffer;
   // Calculate digest
   const digest = await crypto.subtle.digest('SHA-256', buff);
   // Convert ArrayBuffer to hex string
   // (from: https://stackoverflow.com/a/40031979)
   return [].map.call(new Uint8Array(digest), x => ('00' + x.toString(16)).slice(-2)).join('');
 }

// 入力データをチェックする
async function data_check(mail,pass){
  let decision = 1;
  // passwordはハッシュ化前に文字列のチェックを行う
  if(pass.length >= 16 || pass.length <= 0){
    decision = 0;
  }

  if(!pass.match(/^[A-Za-z0-9]*$/)){
    decision = 0;
  }

  return decision;
 }

window.addEventListener("load",function(){
  document.getElementById("login_button").addEventListener("click",function(){
    let mail = document.getElementById("mail").value;
    let pass = document.getElementById("pass").value;
    let errormessage = document.getElementById("errormessage");
    let passSHA256;
    (async () => {

      if(!await data_check(mail, pass)){
        errormessage.innerHTML = "パスワードは半角英数字16文字以下で入力してください";
        return false;
      }

      passSHA256 = await sha256(pass);

      let formDatas;
      let postDatas = new FormData();

      // phpに渡すデータを設定
      postDatas.append('mail', mail);
      postDatas.append('pass', passSHA256);

      let XHR = new XMLHttpRequest();

      //管理者テーブルと突き合わせを行うphpファイルを呼び出す
      XHR.open("POST","./src/php/db/Login.php",true);
      XHR.send(postDatas);
      XHR.onreadystatechange = function(){
        if(XHR.readyState == 4 && XHR.status == 200){
          // ログイン成功時は1
          switch(XHR.responseText){
            case '1':
              window.location.href = 'top.php';
              break;
            case '2':
              errormessage.innerHTML = "半角英数字で入力してください";
              break;
            default:
              errormessage.innerHTML = "メールアドレスまたは、パスワードが間違っています";
          }
        }
      }
    })();
  });
})