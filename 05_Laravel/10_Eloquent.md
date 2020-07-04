<h2 style="color: orange;">Eloquent</h2>
このカリキュラムでは、Eloquentについて学んでいきます。

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>
- Eloquentとは
- Eloquentの使い方

<h2 style="color: orange;">Eloquentとは</h2>
Eloquentとはデータベースとモデルを対応づける機能です。**記述先はモデルやコントローラ**に記述します。<br>

- モデル
  - データベースやテーブル自体に関する設定
- コントローラ
  - レコードの出し入れに関して

<h2 style="color: orange;">準備</h2>
これから実際にEloquentを使用する前に準備をしましょう。<br>

1. routingの処理をroutes.phpへ記入
2. TweetsControllerの作成
3. 値を確認するためのViewの作成

### 1.routingの処理をroutes.phpへ記入
route.phpに "localhost:8000/tweets"とアクセスした場合のroutingを書きましょう。<br>
routes.phpに下記の記述を追加してください。

```
// routes.php

<?php
・・・

Route::get('tweets', 'TweetsController@index'); // 追加
```

### 2.TweetsControllerの作成
実際にEloquentを操作するControllerを作成しましょう。<br>
Controllerの作成方法は<a href="http://hackers.nexseed.net/curriculums/149">こちら</a><br>
作成後に下記の記述を**TweetsController.php**に追加してください。<br>

```
// app/Http/Controllers/TweetsController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet; // 追加

class TweetsController extends Controller
{
    public function index() { // 追加

        return view('tweets.index'); // 追加
    }
}

```

### 3.値を確認するためのViewの作成
View直下に**Tweets**ディレクトリを作成し、その中に**index.blade.php**を作成してください。<br>
作成後に下記の記述を**index.blade.php**に追加してください。<br>

```
// index.blade.php
@extends('layout')

@section('content')
<div>
    <p></p>
</div>
@endsection
```

<br>

これで準備完了です。

<h2 style="color: orange;">Eloquentに触れてみよう</h2>
それでは実際にEloquentを使用していきましょう。<br>
ここではよく使われている二つの書き方をご紹介します。<br>

<h2 style="color: #00FF00;">① all()</h2>
### **例**
**app/Http/Controllers/TweetsController.php**

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet; // 追加①

class TweetsController extends Controller
{
    public function index() {

        $tweets = Tweet::all(); // 追加② "モデル名::Eloquent" の形

        return view('tweets.index', compact('tweets')); // ③compact関数を追加し、②の$tweetsをtweets/index.blade.phpに返す。
    }
}
```

<br>
**resources/views/tweets/index.blade.php** <br>

```
@extends('layout')

@section('content')
<div>
    <p>{{ $tweets[0]['content'] }}</p> // 追加④
</div>
@endsection
```

<br>
### **解説**
①まず始めに使用するモデルを記述する必要があるため、classの上の部分にモデル名を記述します。(①の追加部分)<br>
<br>

```
use App\使いたいモデル名;
```

<br>
記述がない場合、②のモデル名を記述する部分が使用できません。

②$tweetsという変数にTweetsテーブルの全データ(all()の部分)を配列の形で読み込み、代入します。<br>
SQL文でTweet:all()を書くと`SELECT * FROM tweets` となります。<br>
③tweets.indexへ値を送るため、compact関数に②で用意した$tweetsを追加する。<br>
④tweets/index.blade.php上でcontentを表示する

<h2 style="color: #00FF00;">② find()</h2>
### **例**
**app/Http/Controllers/TweetsController.php**

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

        $tweets = Tweet::find(1); // 追加① ()内には存在するレコードのID

        return view('tweets.index', compact('tweets', 'tweet')); // 追加② compact関数にtweetを追加
    }
}
```

<br>
**resources/views/tweets/index.blade.php** <br>

```
@extends('layout')

@section('content')
<div>
    <p>{{ $tweets[0]['content'] }}</p>
    <p>{{ $tweet['content'] }}</p> // 追加
</div>
@endsection
```

### **解説**
①find()メソッドは()内の数字に該当するIDをテーブルから検索しています。<br>
SQL文でTweet:find(1)を書くと`SELECT * FROM tweets WHERE id = 1` となります。<br>


<h2 style="color: orange;">まとめ</h2>

- Eloquentの基礎
  - all()
  - find()
