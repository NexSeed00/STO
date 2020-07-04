<h2 style="color: orange;">Laravel Collective</h2>
<img src="http://hackers.nexseed.net/images/curriculum_images/laravelcollective.png" style="width: 100%"><br>
<br>
LaravelのViewでFormを記述するには直接HTMLを記述する方法とヘルパー関数を使う方法があります。<br>
このカリキュラムは`laravelcollective/html` パッケージをインストールして、ヘルパー関数を使用するためのカリキュラムです。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Laravel Collective導入方法
- Laravel Collective使用方法

<h2 style="color: orange;">Laravel Collective導入方法</h2>
まずは、`composer.json`ファイルの`require`の部分に下記のように記述する。<br>
<br>

```
// composer.json

"require": {
        "php": ">=5.5.9",
        "laravel/framework": "5.1.*",
        "laravelcollective/html": "5.1.*" // カリキュラムで使用しているLaravelのVersionが5.1のため、`5.1.*`と記載している。
    },
```

<br>
上記がかけたら、下記コマンドをCUI上で行う。<br>
<br>

```
composer update
```

<br>
すると、CUI上でcomposerをupdateし始め、下記のような画面になります。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/laracolle_install_phase.png" style="width: 100%"><br>
<br>
ここまでできていればupdateは完了。<br>
あとは数カ所変えるだけ。<br>
`config/app.php`の中身に下記を追加します。<br>
<br>

```
// config/app.php

'providers' => [
    // ...
    Collective\Html\HtmlServiceProvider::class,
    // ...
  ],


'aliases' => [
    // ...
      'Form' => Collective\Html\FormFacade::class,
      'Html' => Collective\Html\HtmlFacade::class,
    // ...
  ],
```

<br>
これで導入完了。最後はcacheやconfigをclearしておきましょう。<br>

```
php artisan config:cache

php artisan cache:clear
```

<br>
これで<a href="http://hackers.nexseed.net/curriculums/167">Helper関数</a>が使用可能になりました。<br>

<h2 style="color: orange;">Laravel Collective使用方法</h2>
Formタグの使用方法をいくつかご紹介したいと思います。<br>

### 1.開始タグ

```
<form method="POST" action="http://localhost:8000/home" accept-charset="UTF-8">
<input name="_token" type="hidden" value="eAFowzR2efsBNQYrVzQ4VymRbYQB2afVyEDijzqd">
↓
Form::open(['url' => 'home'])
```

<br>
inputタグ内のvalueは自動的にCSRFトークンが追加されて出力されます。<br>
### 2.閉じタグ

```
</form>
↓
Form::close()
```

<br>
ものすごいシンプル。
### 3.送信先にルーティング名を指定

```
<form method="POST" action="http://localhost:8000/users" accept-charset="UTF-8">
<input name="_token" type="hidden" value="eAFowzR2efsBNQYrVzQ4VymRbYQB2afVyEDijzqd">
↓
Form::open(['route' => 'users.index'])
```

<br>
action属性にルーティングを適用することができます。
### 4.送信先にURLパラメータ

```
<form method="POST" action="http://localhost:8000/users/1" accept-charset="UTF-8">
<input name="_token" type="hidden" value="eAFowzR2efsBNQYrVzQ4VymRbYQB2afVyEDijzqd">
↓
Form::model($user, ['route' => ['users.update', $user->id]])
```

<br>
ユーザのIDなどURLパラメータをaction属性に含めることもできます。
### 5.ラベル

```
<label for="email">E-Mail Address</label>
↓
Form::label('email', 'E-Mail Address')
```

<br>
### 6.入力フォーム
#### テキスト

```
<input name="username" type="text">
↓
Form::text('username') // ①

<input name="email" type="text" value="example@example.com" id="email">
↓
Form::text('email', 'example@example.com') // ②
```

<br>
①第１引数にname属性の値を指定します。<br>
②第２引数に初期値(value属性の値)を指定します。

#### パスワード

```
<input class="awesome" name="password" type="password" value="">
↓
Form::password('password', ['class' => 'awesome'])
```

<br>

#### メールアドレス

```
<input name="mail" type="email">
↓
Form::email('mail'', $value = null, $attributes = [])
```

<br>

#### 日付

```
<input name="created_at" type="date" value="2018-06-05">
↓
Form::date('created_at', \Carbon\Carbon::now())
```

<br>

#### ファイル

```
<input name="picture_path" type="file">
↓
Form::file('picture_path', $attributes = [])
```

<br>

以上、よく使うFormタグのlaralvelCollectiveバージョンでした。<br>
これを使いこなせるようになると開発も圧倒的に早くなることがわかりますね。

<h2 style="color: orange;">まとめ</h2>

- composer.jsonをいじること
- errorで映らない場合、config:cacheなどのコマンド実行
- {!! Form::XXXX !!}という書き方でlaravelCollectiveは書く
