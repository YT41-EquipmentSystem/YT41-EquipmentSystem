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

window.addEventListener("load",function(){
  document.getElementById("login_button").addEventListener("click",function(){
    let mail = document.getElementById("mail").value;
    let a = document.getElementById("pass").value;
    let pass;
    (async () => {
      pass = await sha256(a);
      let formDatas;
      let postDatas = new FormData();

      // phpに渡すデータを設定
      postDatas.append('mail', mail);
      postDatas.append('pass', pass);

      let XHR = new XMLHttpRequest();

      //管理者テーブルと突き合わせを行うphpファイルを呼び出す
      XHR.open("POST","./src/php/db/Login.php",true);
      XHR.send(postDatas);
      XHR.onreadystatechange = function(){
        if(XHR.readyState == 4 && XHR.status == 200){
          // 検索結果のデータをJson形式から配列に変換
          if(XHR.responseText == 1){
            window.location.href = 'top.html';
          }else{
            let errormessage = document.getElementById("errormessage");
            errormessage.innerHTML = "メールアドレスまたは、パスワードが間違っています。";
            console.log(XHR.responseText);
          }
        }
      }
    })();
  });
})