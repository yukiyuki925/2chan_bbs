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

<!-- スレッドエリア -->
<div class="threadWrapper">
  <div class="childWrapper">
    <div class="threadTitle">
      <span>[タイトル]</span>
      <h1>掲示板作ってみた</h1>
    </div>
    <?php include('commentSection.php'); ?>
    <?php include('commentForm.php'); ?>

  </div>
</div>