<?php
session_start();

//クリックジャッキングへの対策
header('X-Frame-Options: DENY');

//フォームを経ずにこのページに直接アクセスした場合は拒否する
if(!isset($_POST['token'])) {
  echo '不正なアクセスの可能性があります';
  exit;
}

//キーとトークンが一致したら管理者に入力内容がメールで送られる
if($_SESSION['key'] === $_POST['token']) {
  $to = $_SESSION['to'];
  $title = $_SESSION['title'];
  $message = $_SESSION['message'];
  
  //文字化け対策
         mb_language("Japanese");
         mb_internal_encoding("UTF-8");


         if(mb_send_mail($to, $title, $message, $header)){
             //メールが送信出来たら$_SESSIONの値をクリア
    $_SESSION = array();

    //メールが送信出来たらセッションを破棄
    session_destroy();

            echo "メール送信成功です";
         }else{
            echo "メール送信失敗です";
         }} else {
          $message = 'キーとトークンが一致しません';
        }
         
      ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>送信結果</title>
</head>
<body>
  <div id="result">
    <!-- 送信結果を表示 -->
    <div>
      <a href="form.php">元のページに戻る</a>
    </div>
  </div><!-- /#result -->
</body>
</html>