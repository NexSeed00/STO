<?php

require_once('Models/User.php');

$email = $_POST['email'];
$password = $_POST['password'];

// メールアドレスをもとに、データベースからユーザーを取得
$user = new User();
$loginUser = $user->findByEmail([$email]);


// 1. 入力されたメールアドレスが存在しない
//  →ログイン画面に戻る
if (!$loginUser) {
    header('Location: signinForm.php');
    exit;
}

// 2. ユーザーはいたけど、パスワードが一致しない
//  →ログイン画面に戻る

// 画面から送信されたパスワードを暗号化する
if (!password_verify($password, $loginUser['password'])) {
    header('Location: signinForm.php');
    exit;
}

// 3. ユーザーはいて、パスワードが一致
//  →タスク一覧画面に遷移
if (password_verify($password, $loginUser['password'])) {
    // ログイン情報をセッションに保存
    session_start();
    $_SESSION['user'] = $loginUser;
    header('Location: index.php');
    exit;
}
