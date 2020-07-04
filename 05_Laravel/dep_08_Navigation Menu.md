<h2 style="color: orange;">Navigation Menu</h2>
<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- ナビゲーションメニュー作成
- Bootstrap3の機能

<h2 style="color: orange;">Routing</h2>
まずはいつも通り、Routingから。<br>
サイトのrootで、ツイート一覧を表示するよう、`routes.php`を修正します。<br>

```
// app/Http/routes.php

// Route::get('/', 'WelcomeController@index'); コメントアウト
Route::get('contact', 'WelcomeController@contact');
Route::get('about', 'PagesController@about');

Route::get('/', 'TweetsController@index'); // 修正
Route::get('tweets/create', 'TweetsController@create');
Route::get('tweets/{id}', 'TweetsController@show');
Route::post('tweets', 'TweetsController@store');
Route::get('tweets/{id}/edit', 'TweetsController@edit');
Route::patch('tweets/{id}', 'TweetsController@update');
Route::delete('tweets/{id}', 'TweetsController@destroy');
```

<br>
これで`localhost:8000`でリクエストが来た時にTweetsControllerのindexメソッドが呼ばれるようになりました。<br>
<h2 style="color: orange;">Navigation barのpartial作成</h2>
resouces/viewsの直下にnavbar.blade.phpを作成します。素材は<a href="https://getbootstrap.com/docs/3.3/components/">Bootstrap 3</a>のNavbarを参考にしています。<br>
<br>

```
// resources/views/navbar.blade.php

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Learn_SNS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

       <!-- 左寄せメニュー -->
      <ul class="nav navbar-nav">
        <li><a href="/users">Users</a></li>
        <li><a href="/contact">Contact</a></li>
        <li><a href="/about">About</a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>

      <!-- 右寄せメニュー -->
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
          {{-- ログインしていない時 --}}
          <li><a href="/auth/login">Login</a></li>
          <li><a href="/auth/register">Register</a></li>
        @else
          {{-- ログインしている時 --}}
          <!-- ドロップダウンメニュー -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/auth/logout">Logout</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

```

<br>
左寄せメニューには`Users`、`Contact`、`About`があります。<br>
右寄せメニューには`Login`や`Register`などがあります。<br>

### layout.blade.phpにnavbarのpartialを追加

```
// resources/views/layout.blade.php

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Learn_SNS</title>
    {{-- Boostrap導入 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
	{{-- ナビゲーションバーのpartialを使用 --}}
    @include('navbar')

    @yield('content')
    {{-- Boostrap導入 --}}
    <script src="{{ asset('js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.4.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
```

<br>
これでNavigation Menuは実装できました。<br>
最後にしっかり動くかどうか動作確認をするのを忘れないでください。<br>

### <span style="color: red;">注意！！！</span>
`<script src="{{ asset('js/bootstrap.js') }}"></script>`が`<script src="{{ asset('js/jquery-3.1.1.js') }}"></script>`より上にあるとNavbarはうまく動きませんので、順番に注意してください。<br>

<h2 style="color: #33CC00;">やってみよう！</h2>
- `localhost:8000/users`でアクセスできるUser一覧ページを作成してみましょう。<br>
- ContactページやAboutページにもNavbarをつけてみましょう。<br>
- Learn_SNSのファイルの`localhost:8000/tweets`と記述されているリンクを`localhost:8000`に修正しておきましょう。<br>


<h2 style="color: orange;">まとめ</h2>

- navbarのpartial化
- Bootstrapの活用
