<?php

/**
 * 簡易的なサンプルです
 * 本来はファイル名が重複しないように変更したり、
 * 画像サイズの確認、ファイルの種類の確認をして
 * 適切なエラーを表示します
 * 
 * 大まかな流れは
 * 1. データの受け取り
 * 2. 画像の保存
 * 3. DBに保存
 * 4. 元のページに戻る
 */

require_once('dbconnect.php');

// var_dump($_FILES['image']['error']);die;

// データの受け取り
$name = $_POST['name'];
// $_FILES['name属性']['tmp_name']にアップロードしたファイルが一時保存されてる
$file = $_FILES['image']['tmp_name'];

// 画像がアップロードされている場合は、
// エラーコードは以下のページを参照
// https://www.php.net/manual/ja/features.file-upload.errors.php
if ($_FILES['image']['error'] !== 4) {
    $imgPath = 'images/' . $_FILES['image']['name'];
    // 画像の保存
    // 第一引数が対象のファイル、第2引数が保存先
    move_uploaded_file($file, $imgPath);
// そうでなければ(画像がアップロードされていない場合)
} else {
    $imgPath = 'images/default.png';
}

// DBへの保存
$stmt = $dbh->prepare('INSERT INTO users (`name`, image_at) VALUES (?, ?)');
$stmt->execute([$name, $imgPath]);

// 一覧画面にリダイレクト
header('location: index.php');
exit;
