<?php

$user = 'root';
$pass = 'root';

// DBと接続
try {
  $pdo = new PDO('mysql:host=localhost;dbname=2chan_bbs', $user,$pass);
  // echo 'DBの接続に成功しました';
} catch(PDOException $error) {
  echo $error->getMessage();
}