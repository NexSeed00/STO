<h2 style="color: orange;">Middlewareについて</h2>
ログインが出来るようになったので、記事の作成や編集、削除はログインしていないと実行出来ないように制限をかけたいと思います。<br>
Laravel5ではこれらのフィルタリングをMiddlewareの中で実行します。Laravel4の時はフィルターという機能だったのですが、Laravel5ではMiddlewareになりました。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>
- ログインしていない時の動き

<h2 style="color: orange;">Middleware</h2>
Middlewareは以下のディレクトリに格納されています。<br>
Laravelプロジェクトを作成した時点で下記の3つのファイルが作成されています。<br>

```
app/Http/Middleware/

Authenticate.php
RedirectIfAuthenticated.php
VerifyCsrfToken.php

```

<br>
その中のAuthenticate.phpを見てみましょう。<br>

```
app/Http/Middleware/Authenticate.php

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
        	<!-- ログインしていない時 -->
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

		<!-- ログインしている時 -->
        return $next($request);
    }
}
```

<br>
ルートからコントローラのメソッドが呼び出される前に、**handleメソッド**が呼び出されます。<br>
**handleメソッドの中で、アプリケーションの次に進むかどうかを判断しています。**<br>
Authenticate.phpでは、ログインしてない時は、ログインページにリダイレクトしています。<br>
アプリケーションを次に進めるには、$nextコールバックを呼び出します。<br>

<h2 style="color: orange;">Middelwareの登録</h2>
`app/Html/Kernel.php`の中でMiddlewareをシステムに登録します。<br>
<br>

```
// app/Http/Kernel.php

<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'App\Http\Middleware\VerifyCsrfToken',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'App\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
    ];

}
```

<br>
Middlewareのポイントは下記の2点です。<br>

- Middlewareをシステムの全HTTPリクエストに対して実行したい場合は、`$middleware`に登録します。<br>
- Middlewareを特定のルートに対して実行したい場合は、$routeMiddleware にキーと共に登録します。<br>

<h2 style="color: orange;">Controller</h2>
では、実際に TweetsController.phpでMiddelwareを使用してみます。<br>

```
// app/Http/Controllers/TweetsControllers.php

<?php
namespace App\Http\Controllers;

...

class TweetsController extends Controller {

    public function __construct() // 追加
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    ...
}
```

<br>
`__construct`を追加し、その中でMiddlewareを使用するよう設定します。Kernel.phpの $routeMiddlewareプロパティーに設定した時のキー(auth)を引数にして、middlewareメソッドを実行します。<br>
オプション引数に’except’を指定して、Middlewareの対象からindexとshowを外しています。<br>
<br>
Middlewareを記述後、artisanコマンドでrouteを確認します。<br>
<br>

```
php artisan route:list
```

<br>
すると下の画像のように**Middleware欄**を見ると、`auth`が適用されていることが確認できます。<br>
<span style="color: blue;">青く囲まれているところ</span>を見ると`index`と`show`は対象外となっていることも確認できます。<br>
これでログインしていない時に、記事の作成や編集、削除を使用とすると、Middlewareのチェックに引っ掛かり、ログインページヘリダイレクトされるようになりました。<br>しっかりと動作確認をすることを忘れずに。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/confirm_middleware.png" style="width: 100%"><br>

<h2 style="color: orange;">View</h2>
TweetsController.phpにMiddlewareを追加したので、Viewの方もログイン状態に応じてボタンの表示制御を行うように修正します。<br>
まずは、index.blade.php。ログインしている時だけツイートするボタンを押せるようにする。<br>
<br>

```
// resources/views/tweets/index.blade.php

@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<h1>ツイート一覧</h1>
		{{-- ログインしている時だけ表示 --}}
	    @if (Auth::check())
	        <a class="btn btn-success" href="http://localhost:8000/tweets/create">ツイートする</a>
	    @endif

	    {{-- 連想配列の形でも使える --}}
	    {{-- foreachで全件取得 --}}
	    @foreach($tweets as $tweet)
	    	<h3><a href="http://localhost:8000/tweets/{{ $tweet->id }}">{{ $tweet->title }}</a></h3>
	    	<div>{{ $tweet->content }}</div>
	    @endforeach
	</div>
</div>
@endsection

```
<br>
次にshow.blade.php。編集、削除ボタンをログインしている時だけ表示するよう修正。<br>
<br>
```

// resources/views/tweets/show.blade.php

@extends('layout')

@section('content')
<div class="container">
	<div class="row">
        <h1>タイトル : {{ $tweet->title }}</h1>
        <p>内容 : {{ $tweet->content }}</p>
        <p>作成日 : {{ $tweet->published_at }}</p>
        {{-- ログインしている時だけ表示 --}}
    	@if (Auth::check())
            <a href="http://localhost:8000/tweets/{{ $tweet->id }}/edit" class="btn btn-info">編集する</a>
            {{-- <a href="http://localhost:8000/tweets/{{ $tweet->id }}" class="btn btn-danger">削除する</a> --}}
            {!! delete_form(['tweets', $tweet->id]) !!}
        @endif
        <a href="http://localhost:8000/" class="btn btn-success">TOPへ戻る</a>
    </div>
</div>
@endsection
```

<br>

<h2 style="color: #33CC00;">やってみよう！</h2>
- Middleware
新規にMiddlewareを作成するには artisan コマンドを使用します。<br>
<br>

```
php artisan make:middleware MyMiddleware
```

<br>
入力後、`app/Http/Middleware/MyMiddleware.php` がMiddlewareディレクトリの直下に作成されます。<br>

```
// app/Http/Middleware/MyMiddleware.php

<?php namespace App\Http\Middleware;

use Closure;

class MyMiddleware {

    public function handle($request, Closure $next)
    {
        // ここで何かやります。

        return $next($request);
    }

}
```

<h2 style="color: orange;">まとめ</h2>

- Middlewareのシステムへの登録
- ログインしている時 / していない時の挙動を分けることができました。<br>
