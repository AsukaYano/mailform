<?php
session_start();

//クリックジャッキングへの対策
header('X-Frame-Options: DENY');

//トークンの生成
$token = sha1(uniqid(rand(), true));

//トークンを$_SESSIONに格納し、それをキーとする
$_SESSION['key'] = $token;
?>

<!DOCTYPE html>

<html lang="ja">

   <head>
      <meta charset="utf-8">
      <title>メール送信</title>
   </head>

   <body>

      <form action="check.php" method="post">
         <p>送り先</p><input type="text" name="to">
         <p>件名</p><input type="text" name="title">
         <p>メッセージ</p><textarea name="message" cols="60" rows="10"></textarea>
         <!-- 作成したトークンを次のページに引き継ぐ-->
         <p><input type="hidden" name="token" value="<?= $token ?>"></p>
         <p><input type="submit" name="send" value="確認"></p>
      </form>

   </body>

</html>