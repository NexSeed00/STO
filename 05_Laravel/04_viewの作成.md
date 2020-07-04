<h2 style="color: orange;">Viewの作成</h2>
前回はLaravelでページを表示するまでのフローを追いました。<br>
今回は自分で新しいページ（ビュー）を作成し、表示をしてみましょう。

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Viewの作成方法
- Laravelのエラーの読み方
- returnでViewへ値を送る方法

<h2 style="color: orange;">Routingの設定</h2>
Learn_SNSのapp/Http/routes.phpにcontactへのGETアクセスの設定を追加します。<br><br>

```
// app/Http/routes.php

Route::get('/', 'WelcomeController@index');
Route::get('contact', 'WelcomeController@contact');   // 追加
```

<br>

Route::get()の第一引数にURLの "localhost:8000/〇〇/" ←〇〇の部分に当てはまる文字列を入れます。<br>
今回はcontactページをページを作成していきますので、localhost:8000/contact/となるようにRoutingで設定しています。



<h2 style="color: orange;">Controllerの設定</h2>
WelcomeControllerにcontactメソッドを追加します。<br><br>

```
// app/Http/Controllers/WelcomeController.php
 
<?php namespace AppHttpControllers;
 
class WelcomeController extends Controller {

    public function index() {
	return view('welcome');
    }

    public function contact()  // 追加
    {
        return "contact";  // view関数を使わず、文字列を返してみる
    }
}
```

<br>

ブラウザで **http://localhost:8000/contact** にアクセスしてみると**"contact"**と表示されます。<br>
Viewを使わずにテキストで好きな文字列を返してみました。
このように**return "好きな文字列"** という形で好きな文字列のみ送ることもできます。<br>
では今度はViewを表示させましょう。Viewを表示させるにはView関数を使用します。<br>

```
// app/Http/Controllers/WelcomeController.php

    public function contact()
    {
         return view('contact');  // view関数に変更
    }
}
```

<br>

そして、ブラウザでhttp://localhost:8000/contact にアクセスすると、下記のような画面が出ます。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/cannotfind_view.png" style="width: 100%"><br>
<br>
初めてみるLaravelのエラーですね。<br>
これは**「"contact"なんてviewは見つからないよー」**とLaravelが教えてくれています。<br>

<h2 style="color: orange;">Viewの作成</h2>
では、Viewを作成しましょう。今回のファイル名はcontact.blade.phpです。<br>

```
<!-- app/resources/view/contact.blade.php -->
<!DOCTYPE HTML>
<html>
<head>
    <title>Contact</title>
</head>
<body>
    <h1>やっと会えたね、Contact...</h1>
</body>
</html>
```

<br>
そして、Laravel内のサーバーを下記のコマンドで立ち上げます。<br>
<br>

```
Mac↓

php artisan serve

Windows↓

php -S localhost:8000 -t public
```

<br>
最後にブラウザで **http://localhost:8000/contact** にアクセスすると、下記のような画面が出ていれば成功です。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/lara_contact_page.png" style="width: 100%"><br>

<h2 style="color: orange;">まとめ</h2>

- return で好きな文字列を返すこともできる
- Viewが見つからない時のエラー対処法
- Routingの書き方
	- Route::get('localhost:8000以降のURL', 'コントローラー名@メソッド名');
