<h2 style="color: orange;">認証機能</h2>
Laravel5.1ではプロジェクトを作成した時点で、**ユーザ登録**、**ログイン認証**、**パスワード再設定の機能**がすぐ使えるように、コントローラが用意されています。<br>
しかし、これらの機能を使うためのRouting設定やViewの作成は**自分で行う必要**があります。このカリキュラムではユーザ登録とログイン認証の実装を行います。<br>
Laravelプロジェクトを作成した時に、デフォルトで`ユーザーとパスワード再設定用の 2つのマイグレーションファイルが作成されています。`<br>
マイグレーションを１度でも実行済であれば、必要なデータベースの項目は既に出来ているので説明は省きます。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- ログイン認証の実装
- ユーザ登録実装

<h2 style="color: orange;">Routing</h2>
まずは認証機能を使用するため、Routingの設定から入ります。<br>
routes.phpに下記の記述を加えてください。<br>

```
// app/Http/routes.php

<?php

...

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', 'WelcomeController@index');
Route::get('contact', 'WelcomeController@contact');
Route::get('about', 'PagesController@about');

Route::get('/', 'TweetsController@index'); // 修正
Route::get('tweets/create', 'TweetsController@create');
Route::get('tweets/{id}', 'TweetsController@show');
Route::post('tweets', 'TweetsController@store');
Route::get('tweets/{id}/edit', 'TweetsController@edit');
Route::patch('tweets/{id}', 'TweetsController@update');
Route::delete('tweets/{id}', 'TweetsController@destroy');

// ログイン/ログアウト機能
Route::get('auth/login', 'Auth\AuthController@getLogin'); // 追加
Route::post('auth/login', 'Auth\AuthController@postLogin'); // 追加
Route::get('auth/logout', 'Auth\AuthController@getLogout'); // 追加

// ユーザー登録機能
Route::get('auth/register', 'Auth\AuthController@getRegister'); // 追加
Route::post('auth/register', 'Auth\AuthController@postRegister'); // 追加

// Route::controller('auth', 'Auth\AuthController');  // ①
```

<br>
５つのルートを追加しましたが、上記の５つを登録する代わりに①の Implicit Controller（暗黙コントローラ）を使うこともできます。<br>

### Routing確認
CUI上に下記コマンドを入力してrouteを確認します。<br>
<br>

```
php artisan route:list
```

<br>
すると、下記のように5つルートが追加されていることがわかります。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/auth_routes.png" style="width: 100%"><br>

<h2 style="color: orange;">ナビゲーション</h2>
右寄せにしているメニューの一部分を修正していきます。<br>
<br>

```
// resources/views/navbar.blade.php

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <!-- スマホやタブレットで表示した時のメニューボタン -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- ブランド表示 -->
            <a class="navbar-brand" href="http://localhost:8000">Learn_SNS</a>
        </div>

        <!-- メニュー -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- 左寄せメニュー -->
            <ul class="nav navbar-nav">
                <li><a href="/users">Users</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/about">About</a></li>
            </ul>

            <!-- 右寄せメニュー -->
            <ul class="nav navbar-nav navbar-right">

                @if (Auth::guest())
                    {{-- ログインしていない時 --}} // ①

                    <li><a href="/auth/login">Login</a></li>
                    <li><a href="/auth/register">Register</a></li>
                @else
                    {{-- ログインしている時 --}} // ②
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
### 解説
①Authファサードを使用してログインユーザーの情報にアクセスしています。`Auth::guest()`でログイン中かどうか判断し、メニューの表示を切り替えます。<br>
②`Auth::user()->name`で**ログインユーザー名を取得**しています。ルート定義に基づいて、Login, Register, Logoutのリンクパスを指定しました。<br>


<h2 style="color: orange;">Viewの作成</h2>
login.blade.phpとregister.blade.phpを作成します。<br>

### resources/views/auth/login.blade.php
```
@extends('layout')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Login</div>
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

          <form class="form-horizontal" role="form" method="POST" action="/auth/login">
            {{-- CSRF対策--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> Remember Me
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                  Login
                </button>

                <a href="/password/email">Forgot Your Password?</a>
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
### resources/views/auth/register.blade.php

```
@extends('layout')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Register</div>
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

          <form class="form-horizontal" role="form" method="POST" action="/auth/register">
            {{-- CSRF対策--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-4 control-label">Name</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
              </div>
            </div>

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
                  Register
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
今回はHelper関数を使用せず、formタグを一つ一つ書いています。<br>
この場合、CSRF対策としてのトークンを自分で埋め込む必要がありますので注意してください。<br>

<h2 style="color: orange;">AuthControllerの修正</h2>
`AuthController.php`を修正し、ユーザー登録後やログイン後のリダイレクト先を指定します。<br>
<br>

```
// app/Http/Controllers/Auth/AuthController.php

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/'; // 追加。登録後やログイン後のリダイレクト先

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
```

<br>
ここまできたらユーザー登録してみましょう。<br>
<h2 style="color: orange;">ユーザー登録・ログイン・ログアウト</h2>
まず、初めにユーザー登録してみましょう。<br>
1. navbarにある**Register**をクリックして、ユーザー登録を行なってください。
2. ユーザー情報が登録できたらログインしてみてください。
3. ログインができたらログアウトしてみてください。

<h2 style="color: orange;">まとめ</h2>

- ユーザー登録・ログイン・ログアウトができるようになった
