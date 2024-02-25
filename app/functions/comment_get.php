<?php
$comment_array = array();

// コメントをテーブルから取得してくる
$sql = "SELECT * from comment";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$comment_array = $stmt;
?>