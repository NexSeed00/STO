<h2 style="color: orange;">パスワードの再設定</h2>
前回、認証でユーザー登録を行いました。<br>
今回はパスワードの再設定を実装します。この処理はパスワードを忘れてしまって、ログイン出来なくなってしまった時に、メールを送信してパスワードの再設定を行える機能です。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- パスワードの再設定方法
- メールの環境設定

<h2 style="color: orange;">Laravel メール設定</h2>
Laravelでパスワードの再設定を行う際にメールを使用します。メールを使用する際の設定を行なっていきます。<br>

### .env
**.env**は開発環境やステージング環境、本番環境などで変更したい情報をまとめておくファイルです。<br>
そこに、メールに関するKEY=VALUEを追加していきます。使用するのはGmailと仮定します。<br>
<br>

```
// .env

APP_ENV=local
APP_DEBUG=true
APP_KEY=y7hzIGgRvik05HTpZ9M2zqzrNzP0WWW1

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=testlara
DB_USERNAME=root
DB_PASSWORD=
DB_SOCKET=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=Gmailのアドレス
MAIL_FROM_NAME=メールの名前
MAIL_USERNAME=htakeishi@nexseed.net
MAIL_PASSWORD=engineernexseed007
MAIL_PRETEND=false
```

<br>
### 解説
①MAIL_DRIVER=smtp でSMTPでメールを送信することを指定します。<br>
②MAIL_HOST 〜 MAIL_PASSWORD まではGmailでSMTP認証する際に必要な値です。必要に応じて変更してください。<br>
③MAIL_PRETEND は true にすると、実際にはメールを送信せずに、メール送信したことをログに書き出します。今回は false にして実際に Gmailにメールを送ってみます。<br>
<br>
なお、gitを使っている場合は、.envを .gitignoreファイルに追加して、管理対象から外して下さい。

### config/mail.php
config/mail.php がメールの設定を行うファイルです。<br>
config/mail.php のデフォルトでは .envを参照するようにはなっていない項目もありますが、以下のように修正します。<br>
```

// config/mail.php


<?php

return [
    // Mail Driver
    'driver' => env('MAIL_DRIVER', 'smtp'),

    // SMTP Host Address
    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),

    // SMTP Host Port
    'port' => env('MAIL_PORT', 587),

    // Global "From" Address
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', null),
        'name' => env('MAIL_FROM_NAME', null)
    ],

    // E-Mail Encryption Protocol
    'encryption' => env('MAIL_ENCRYPTION', null),

    // SMTP Server Username
    'username' => env('MAIL_USERNAME', null),

    // SMTP Server Password
    'password' => env('MAIL_PASSWORD', null),

    // Sendmail System Path
    'sendmail' => '/usr/sbin/sendmail -bs',

    // Mail "Pretend"
    'pretend' => env('MAIL_PRETEND', false),
];
```

<br>
env関数を使って、値を.envファイルから取得しています。<br>
envで設定した `MAIL_PRETEND`を `true`にしてみます。実際にはメール送信は実行されず、ログだけ出力されます。<br>
ローカル環境で開発中にメールを送信したくない時に使います。<br>

### メール送信確認
php artisan tinkerコマンドを使用してメールの送信テストを行ってみましょう。<br>
<br>

```
php artisan tinker
```

<br>

Mail::raw() を使用してサンプルのテキストメールを送信してみます。<br>
そして、下記のようなレスポンスが返ってくれば成功です。<br>
<br>

```
Mail::raw('Test Mail', function($message) { $message->to('somebody@example.com')->subject('test'); });
=> 1
>>>
```

<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/test_mail.png" style="width: 100%"><br>
<br>
`1`が表示されていればしっかりメールが飛ばされている証拠です。<br>

<h2 style="color: orange;">Routing</h2>
いつも通りまずはRoutingから。以下のルートを追加します。<br>

```
// app/Http/routes.php

...

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail'); // 追加
Route::post('password/email', 'Auth\PasswordController@postEmail'); // 追加

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset'); // 追加
Route::post('password/reset', 'Auth\PasswordController@postReset'); // 追加

// Route::controller('password', 'Auth\PasswordController'); // ①
```

<br>
追加している4つを追加する代わりに①を追加することでも同じです。<br>

### artisan コマンドでルートを確認
下記のコマンドでrouteを確認してみましょう。<br>
<br>

```
php artisan route:list
```

<br>
CUI上で確認してみましょう。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/password_route_list.png" style="width: 100%"><br>
<br>
しっかりとrouteが追加されていることが確認できました。<br>

<h2 style="color: orange;">Viewの作成</h2>
パスワード再設定のViewを以下のように作成します。<br>
<br>

```
resources/views/auth/password.blade.php // ①
resources/views/auth/reset.blade.php // ②

resources/views/emails/password.blade.php // ③
```

<br>
各Viewの役割は以下の通りです。<br>
①パスワード再設定メール送信<br>
②パスワード再設定<br>
③パスワード再設定メール作成<br>
<br>
それぞれのViewを作成していきましょう。<br>
### resources/views/auth/password.blade.php

```
@extends('layout')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Reset Password</div>
        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="form-horizontal" role="form" method="POST" action="/password/email">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-4 control-label">E-Mail Address</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Send Password Reset Link
                </button>
              </div>
            </div>
          </form>
        </div><!-- .panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->
@endsection
```

<br>
### resources/views/auth/reset.blade.php

```
@extends('layout')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Reset Password</div>
        <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="form-horizontal" role="form" method="POST" action="/password/reset">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
              <label class="col-md-4 control-label">E-Mail Address</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Confirm Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password_confirmation">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Reset Password
                </button>
              </div>
            </div>
          </form>
        </div><!-- panel-body -->
      </div><!-- .panel -->
    </div><!-- .col -->
  </div><!-- .row -->
</div><!-- .container-fluid -->
@endsection
```

<br>
### resources/views/emails/password.blade.php

```
Click here to reset your password: {{ url('password/reset/'.$token) }}
```

<br>
これでViewは完了です。次はControllerを修正していきましょう。<br>
<h2 style="color: orange;">Controller</h2>
PasswordController.php を修正し、パスワード再設定後のリダイレクト先を指定します。<br>
リダイレクト先を指定しなかった場合は、`/home`へリダイレクトするように、ResetsPasswords トレイトの中で、ハードコーディングされています。<br>
ResetsPasswords トレイトの中身はざっと目を通しておくことをお薦めします。<br>

```
// app/Http/Controllers/Auth/PasswordController.php

class PasswordController extends Controller {
    use ResetsPasswords;

    protected $redirectTo = '/';    // パスワード再設定後のリダイレクト先
```

<br>
以上で、パスワードの再設定ができるようになりました。<br>
実際に再設定ができるか確認してみましょう。<br>

<h2 style="color: #33CC00;">やってみよう！</h2>

- パスワードの再設定をしてみよう。<br>
①ログインしている場合は、ログアウトします。<br>
②ログイン画面を表示します。<br>
③`Login`ボタンの右にある`Forget Your Password?` をクリックすると、`Reset Password`画面が表示されます。<br>
④登録済のメールアドレスを入力して、`Send Password Rest Link`ボタンをクリックします。<br>
⑤クリック後、1~2分以内に下記のようなメールが届きます。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/mail_detail.png" style="width: 100%"><br>
<br>
メールの内容解説<br>
1. メールのタイトル部分は`・vendor/laravel/framework/src/Illuminate/Foundation/Auth/ResetsPasswords.php`内にあるgetEmailSubject()メソッド内に記述されている文でメール送信時に呼び出されるようになってます。<br>
2. .envファイルのMAIL_FROM_NAMEの部分
3. .envファイルのMAIL_FROM_ADDRESSの部分
4. resources/views/emails/password.blade.phpの内容
<br>
メール内のURLにWWWブラウザでアクセスします。<br>
⑥`Reset Password` 画面が現れるので、登録済メールアドレスと、新しいパスワードを入力して、`Reset Password`ボタンをクリックします。<br>
⑦記事一覧が表示され、ナビゲーションの右上にユーザー名が表示されます。<br>
<br>
念のため、一旦ログアウトして、新しいパスワードでログインできるかも確認しておくと良いでしょう。<br>

<h2 style="color: orange;">まとめ</h2>

- メールを使用してパスワードの再設定ができるようになりました。
- メールの環境設定ができるようになりました。

