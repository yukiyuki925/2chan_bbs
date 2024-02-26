<?php

// エラーを連想配列で格納
$error = array();

// 'submitButton'が送信されたら->submitボタンが押されたら
if (isset($_POST['submitButton'])) {

  // 名前入力チェック
  if(empty($_POST["username"])) {
  $error["username"] = '名前を入力してください';
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

  // トランザクション開始
  $pdo->beginTransaction();

  try {
    $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`, `thread_id`) VALUES (:username, :body, :post_date, :thread_id);";
  $stmt = $pdo->prepare($sql);

  // 値をセットする
  $stmt->bindParam(":username", $escaped['username'], PDO::PARAM_STR);
  $stmt->bindParam(":body", $escaped['body'], PDO::PARAM_STR);
  $stmt->bindParam(":post_date", $post_date, PDO::PARAM_STR);
  $stmt->bindParam(":thread_id", $_POST["threadID"], PDO::PARAM_INT);

  $stmt->execute();
  $pdo->commit();
  } catch(Exception $e) {
    $pdo->rollBack();
  }
  
  }
}
?>