<?php
$thread_array = array();

// コメントをテーブルから取得してくる
$sql = "SELECT * from thread";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$thread_array = $stmt;

// DB接続を切る
$pdo = null;
$stmt = null;

?>