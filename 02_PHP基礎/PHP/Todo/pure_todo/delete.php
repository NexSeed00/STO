<?php

// ファイルの読み込み
require_once('dbconnect.php');
require_once('function.php');

// データの受け取り
$id = $_POST['id'];

// DBからデータの削除
$stmt = $dbh->prepare('DELETE FROM tasks WHERE id = ?');
$stmt->execute([$id]);

// リダイレクト
header("location: index.php");