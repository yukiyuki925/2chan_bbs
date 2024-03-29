<?php

// エラーを連想配列で格納
$error = array();

// 'submitButton'が送信されたら->submitボタンが押されたら
if (isset($_POST['threadSubmitButton'])) {

  // スレッド入力チェック
  if(empty($_POST["title"])) {
  $error["title"] = '名前を入力してください';
  } else {
  // エスケープ処理
  $escaped['title'] = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
  }

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
      // スレッドを追加
  $sql = "INSERT into `thread` (`title`) VALUES (:title);";
  $stmt = $pdo->prepare($sql);

  // 値をセットする
  $stmt->bindParam(":title", $escaped['title'], PDO::PARAM_STR);
  $stmt->execute();

  // コメントも追加する
  $sql = "insert into comment (username, body, post_date, thread_id) values (:username, :body, :post_date, (select id from thread where title = :title))";
  $stmt = $pdo->prepare($sql);

  // 値をセットする
  $stmt->bindParam(":username", $escaped["username"], PDO::PARAM_STR);
  $stmt->bindParam(":body", $escaped["body"], PDO::PARAM_STR);
  $stmt->bindParam(":post_date", $post_date, PDO::PARAM_STR);
  $stmt->bindParam(":title", $escaped["title"], PDO::PARAM_STR);

  $stmt->execute();
  $pdo->commit();
  } catch (Exception $e) {
    $pdo->rollback();
  }
  }

  // 掲示板ページに遷移
  header("Location: http://localhost:8888/2chan_bbs/");
}
?>