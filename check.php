<html>
   <head>
      <meta charset="utf-8">
   </head>

   <body>

      <?php

         session_start();

         //クリックジャッキングへの対策
         header('X-Frame-Options: DENY');

         //フォームを経ずにこのページに直接アクセスした場合は拒否する
         if(!isset($_POST['token'])) {
            echo '不正なアクセスの可能性があります';
            exit;
         }
         
         mb_language("Japanese");
         mb_internal_encoding("UTF-8");

         $to = $_POST['to'];
         $title = $_POST['title'];
         $message = $_POST['message'];
         $header = "From: test@test.com";

         //エスケープ処理
         $to = htmlspecialchars($_POST['to']);
         $title = htmlspecialchars($_POST['title']);
         $message = htmlspecialchars($_POST['message']);


         if (strlen($_POST['message']) > 10) {
            echo "文字数がオーバーしています。";
         }
         if(empty($_POST['to'])){
            echo "送り先が入力されていません。";
         }
         if(empty($_POST['message'])){
            echo "メッセージが入力されていません。";
         }
         
      ?>

<div id="check">
  <h1 class=check-title>入力内容の確認</h1>
  <p class=check-lead>以下の内容で送信してよろしいですか？</p>

  <ul class="check-list">
    <li class="check-item">送り先 : <?= $to; ?></li>
    <li class="check-item">件名 : <?=  $title; ?></li>
    <li class="check-item">メッセージ : <?= $message; ?></li>
  </ul>
  
  <form class="form" method="post" action="mail.php">
    <div>
      <!-- 入力フォームから送られてきたトークンを次のページに引き継ぐ -->
      <input type="hidden" name="token" value="<?= $_POST['token'] ?>">
      <ul class="btn-box">
        <li>
          <button type="button" class='back' onclick="history.back()">戻 る</button>
        </li>
        <li>
          <button type="submit" class='submit'>送 信</button>
        </li>
      </ul>
    </div>
  </form>
  
</div>

   </body>

</html>