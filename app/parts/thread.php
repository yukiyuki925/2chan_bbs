<?php

// データベースに接続
include_once("./app/database/connect.php");
include_once("./app/functions/comment_add.php");
include_once("./app/functions/comment_get.php");
include_once("./app/functions/thread_get.php");

?>

<!-- バリデーションチェックのエラー文吐きだし -->
<?php if (isset($_POST['submitButton']) && isset($error)): ?>
<ul class="errorMessage">
  <?php foreach ($error as $errors) : ?>
  <li><?php echo $errors ?></li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>

<!-- スレッドエリア -->
<?php foreach ($thread_array as $thread) :?>
<div class="threadWrapper">
  <div class="childWrapper">
    <div class="threadTitle">
      <span>[タイトル]</span>
      <h1><?php echo $thread['title'] ?></h1>
    </div>
    <?php include('commentSection.php'); ?>
    <?php include('commentForm.php'); ?>

  </div>
</div>
<?php endforeach; ?>