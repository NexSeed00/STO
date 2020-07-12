<?php

// ファイルの読み込み
require_once('dbconnect.php');
require_once('function.php');

// データの受け取り
$title = $_POST['title'];
$contents = $_POST['contents'];
$id = $_POST['id'];

// DBのデータ更新
$stmt = $dbh->prepare('UPDATE tasks SET title = ?, contents = ? WHERE id = ?');
$stmt->execute([$title, $contents, $id]);

// リダイレクト
header('location:index.php');