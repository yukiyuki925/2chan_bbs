<?php

// データベースに接続
include_once("./app/database/connect.php");

// エラーを連想配列で格納
$error = array();

// 'submitButton'が送信されたら->submitボタンが押されたら
if (isset($_POST['submitButton'])) {

  // 名前入力チェック
  if(empty($_POST["username"])) {
    $error["username"] = 'お名前を入力してください';
  } else {
    // エスケープ処理
    $escaped['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
  }

  // コメント入力チェック
  if(empty($_POST["body"])) {
    $error["body"] = 'コメントを入力してください';
  } else {
    // エスケープ処理
    $escaped['body'] = htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8');
  }

  if(empty($error)) {
    $post_date = date("Y-m-d H:i:s");

    $sql = "INSERT into `comment` (`username`, `body`, `post_date`) VALUES (:username, :body, :post_date);";
    $statement = $pdo->prepare($sql);

    // 値をセットする
    $statement->bindParam(":username", $escaped['username'], PDO::PARAM_STR);
    $statement->bindParam(":body", $escaped['body'], PDO::PARAM_STR);
    $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);

    $statement->execute();
  }
  
}

$comment_array = array();

// コメントをテーブルから取得してくる
$sql = "SELECT * from comment";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$comment_array = $stmt;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2chan</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <header>
    <h1 class="title">2chan掲示板</h1>
    <hr>
  </header>

  <!-- バリデーションのエラー文を出力 -->
  <?php if(isset($error)): ?>
  <ul class="errorMsg">
    <?php foreach($error as $errors): ?>
    <li><?php echo $errors ?></li>
    <?php endforeach ?>
  </ul>
  <?php endif; ?>

  <!-- スレッドエリア -->
  <div class="threadWrapper">
    <div class="childWrapper">
      <div class="threadTitle">
        <span>[タイトル]</span>
        <h1>掲示板作ってみた</h1>
      </div>
      <section>
        <?php foreach($comment_array as $comment): ?>
        <article>
          <div class="wrapper">
            <div class="nameArea">
              <span>名前:</span>
              <p class="username"><?php echo $comment['username']; ?></p>
              <time>：<?php echo $comment['post_date'] ?></time>
            </div>
            <p class="comment"><?php echo $comment['body']; ?></p>
          </div>
        </article>
        <?php endforeach ?>
      </section>
      <form class="formWrapper" method="POST">
        <div>
          <input type="submit" value="書き込む" name="submitButton">
          <label>名前：</label>
          <input type="text" name="username">
        </div>
        <div>
          <textarea class="commentTextArea" name="body"></textarea>
        </div>
      </form>
    </div>
  </div>
</body>

</html>