<h2 style="color: orange;">Formの作成</h2>
一通りMVCモデルに触れ、Bootstrapも導入しました。<br>
ここからは実際にDBへのCRUD処理やPOST送信やGET送信、Eloquentについて深く学んでいきます。<br>
その手始めとなるのがFormについてです。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Formの作成
- CSRFについて
- POST送信時のRouting

<h2 style="color: orange;">ツイート投稿画面を作成</h2>
下記をroutes.phpに追加し、ツイート投稿画面を作成します。<br>

```
// app/Http/routes.php

<?php

...

Route::get('tweets', 'TweetsController@index');
Route::get('tweets/create', 'TweetsController@create'); // 追加
Route::get('tweets/{id}', 'TweetsController@show');
```

<br>
tweets/createのルーティングの設定をしました。<br>

### <span style="color: red;">ここで注意！！！</span>
上記の
<br>

`Route::get('tweets/create', 'TweetsController@create');`<br>
は必ず<br>

 `Route::get('tweets/{id}', 'TweetsController@show');`<br>
 
より先に追加します。<br>

<br>

理由は`tweets/create`にGET送信された時に、`tweets/{id}`の方が先にヒットし、`TweetsController@show` が実行されてしまうのです。<br>ルートは記述した順に、上からマッチングされていくのでRoutingをする際は気をつけましょう。<br>

### Controllerへcreateメソッド追加
routingが終わり、今度はControllerの出番です。<br>

```
// app/Http/Controllers/TweetsController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;

class TweetsController extends Controller
{
    ...

    public function create() { // 追加

        return view('tweets.create');

    }

    public function show($id) {

        $tweet = Tweet::findOrFail($id);

        // dd($tweet);
        return view('tweets.show', compact('tweet'));
    }
}
```

<br>
createメソッドを追加し、view関数でtweets/create.blade.phpに返しています。<br>
Viewを作成しましょう。<br>

### resources/views/tweets/create.blade.phpを作成

新しくcreate.blade.phpを作成し、ファイル内にformを作成します。<br>

```
// resources/views/tweets/create.blade.php

@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <h1>ツイートを投稿</h1>
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="title">Tweet</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control" placeholder="ツイートを入力してください"></textarea>
                </div>
                <div class="form-group">
                    <input class="form-control" name="published_at" type="date">
                </div>
                <div class="form-group">
                    <input type="submit" value="ツイートする" class="form-control btn-info">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
```

<br>
Viewでフォームを確認します。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/form_laravel.png" style="width: 100%"><br>
<br>
早速前回行ったBootstrapを使用し、見栄えが綺麗なフォームを作成してみました。<br>
ここまで書けたらPOST送信をした際のRoutingを設定しましょう。<br>

### POST送信用のRouting設定
routes.phpに新しくPOST送信用のRoutingを追加します。<br>
<br>
```
// app/Http/routes.php

<?php

...

Route::get('tweets', 'TweetsController@index');
Route::get('tweets/create', 'TweetsController@create');
Route::get('tweets/{id}', 'TweetsController@show');
Route::post('tweets/create', 'TweetsController@store'); // 追加
```
<br>
### <span style="color: #33CC00;">ここでポイント！！！</span>
今回は**送信方法がPOSTのため、getではなくpostを使用**しています。<br>
Routingはここでgetで送信されているか、postで送信されているかを判断します。<br>
TweetsControllerのcreateメソッドを読み込んでいます。<br>
storeメソッドを追加しましょう。<br>

### TweetsControllerにstoreメソッドを追加

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;

class TweetsController extends Controller
{
    public function index() {

        $tweets = Tweet::all();

        // dd($tweets);
        return view('tweets.index', compact('tweets'));
    }

    public function create() {

        return view('tweets.create');

    }

    public function show($id) {

        $tweet = Tweet::findOrFail($id);

        // dd($tweet);
        return view('tweets.show', compact('tweet'));
    }

    public function store() { // 追加

        $inputs = \Request::all(); // ①

        Tweet::create($inputs); // ②

        return redirect('tweets'); // ③
    }

}
```

### 解説
①`\Request:all()`でPOST送信されている内容を全て取得し、$inputsに代入<br>
②Eloquent マスアサインメントを使って、ツイートをDBに作成<br>
③redirect関数を使用してtweetsのページへリダイレクトしています。つまり、tweetsの値でRouteから再度アクセスし直していることになります。<br>
意味合いはseed_snsなどで使用した`header()関数`と同じ<br>
<br>
これで送信された際にstoreメソッドを通ってtweet一覧ページ(`localhost:8000/tweets`)に戻ることができる。

<h2 style="color: orange;">POST送信実践</h2>
<a href="localhost:8000/tweets/create"> localhost:8000/tweets/create </a>ページで実際にツイートしてみましょう。<br>
<br>
すると下記のようなエラーが出てきます。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/csrf_error.png" style="width: 100%"><br>
<br>

### <span style="color: #33CC00;">ここでポイント！！！</span>
このエラーの原因として、Laravelでは、アプリケーションにより管理されているアクティブなユーザーの各セッションごとに、**CSRF「トークン」を自動的に生成しています。**<br>
そのため、**このトークンを認証済みのユーザーのみ、POST送信が有効**になります。<br>
有効化するためには、formタグ内に下記の関数を書く必要があります。<br>
<br>
```

{{ csrf_field() }}

```
<br>
Laravelでは、**<span style="color: red;">クロス・サイト・リクエスト・フォージェリ(CSRF)</span>**からアプリケーションを簡単に守れます。<br>
**<span style="color: red;">クロス・サイト・リクエスト・フォージェリ(CSRF)</span>**はXSS(クロスサイトスクリプティング)のような悪意のある攻撃の一つで、信頼できるユーザーになり代わり、認められていないコマンドを実行します。<br>
<br>
詳しくは<a href="https://readouble.com/laravel/5.3/ja/csrf.html">こちら</a>を参考にしてください。<br>
<br>
ということで、`{{ csrf_field() }}` をcreate.blade.phpのformタグ内に追加しましょう。<br>
<br>

```
// resources/views/tweets/create.blade.php

@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <h1>ツイートを投稿</h1>
        <div class="col-md-6">
            <form action="" method="POST">
            {{ csrf_field }} // 追加
                <div class="form-group">
                    <label for="title">Tweet</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control" placeholder="ツイートを入力してください"></textarea>
                </div>
                <div class="form-group">
                    <input class="form-control" name="published_at" type="date">
                </div>
                <div class="form-group">
                    <input type="submit" value="ツイートする" class="form-control btn-info">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
```

<br>
実際にPOST送信して値がDBへ保存されるか確認してみましょう。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/confirm_db.png" style="width: 100%"><br>
<br>
published_at以外しっかり保存されていることがわかります。<br>
published_atについては次のカリキュラムで触れていくので今は置いておきましょう。<br>

<h2 style="color: #33CC00;">やってみよう！</h2>
- `localhost:8000/tweets`のページに「ツイートする」ボタンを作成し、`localhost:8000/tweets/create`にアクセスできるようにしてください。

<h2 style="color: orange;">まとめ</h2>

- Routingの設定方法
- POST送信し、DBに値が保存できた
- CSRF(クロス・サイト・リクエスト・フォージェリ)

