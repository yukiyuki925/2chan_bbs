<?php

include_once("./app/database/connect.php");

if (isset($_POST['submitButton'])) {
  $username = $_POST['username'];
  var_dump($username);
  $body = $_POST['body'];
  var_dump($body);
}

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

  <!-- スレッドエリア -->
  <div class="threadWrapper">
    <div class="childWrapper">
      <div class="threadTitle">
        <span>[タイトル]</span>
        <h1>掲示板作ってみた</h1>
      </div>
      <section>
        <article>
          <div class="wrapper">
            <div class="nameArea">
              <span>名前:</span>
              <p class="username">taro</p>
              <time>：2022/7/16 14:20</time>
            </div>
            <p class="comment">手書きのコメント</p>
          </div>
        </article>
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