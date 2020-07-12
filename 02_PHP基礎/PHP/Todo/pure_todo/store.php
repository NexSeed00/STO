<?php

// ファイルの読み込み
require_once('dbconnect.php');
require_once('function.php');

// データの受け取り
$title = $_POST['title'];
$contents = $_POST['contents'];
$currentTime = date("Y/m/d H:i:s");

// DBへのデータ保存
$stmt = $dbh->prepare('INSERT INTO tasks (title, contents, created) VALUES (?, ?, ?)');
$stmt->execute([$title, $contents, $currentTime]);//?を変数に置き換えてSQLを実行

// リダイレクト
header('location:index.php');