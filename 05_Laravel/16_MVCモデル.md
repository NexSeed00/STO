<h2 style="color: orange;">MVCモデルの実践</h2>
<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_1.png" style="width: 80%;"><br>
<br>
今までControllerからViewに表示する流れ、モデルを作成し、php artisan tinkerコマンドを使ってモデルを操作し、DBに追加・削除などをしてきました。<br>
このカリキュラムは本格的に<a href="http://hackers.nexseed.net/curriculums/84">MVCモデル</a>を使用していきます。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- MVCモデルのフロー
- Eloquent
	- findOrFail()メソッド

<h2 style="color: orange;">Routing</h2>

```
// app/Http/routes.php

Route::get('tweets', 'TweetsController@index');
Route::get('tweets/{id}', 'TweetsController@show'); // 追加①
```

<br>

### 解説
①つまりlocalhost:8000/tweets/{id} ←このようになります。<br>

**{id}** とは、showメソッドに対してidパラメータ引き渡すことを意味しています。<br>

次はControllerに処理を書いていきます。<br>

<h2 style="color: orange;">Controller</h2>

```
// app/Http/Controllers/TweetsController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet; // モデルを使用するためクラスを記述する必要がある

class TweetsController extends Controller
{
    public function index() {

    	$tweets = Tweet::all();

    	return view('tweets.index', compact('tweets'));
    }

    public function show($id) { // ①

    	$tweet = Tweet::findOrFail($id); ②

    	return view('tweets.show', compact('tweet')); ③
    }
}

```

<br>

### 解説
①show()メソッド内にパラメータで送られた$idを入れる。<br>

②**findOrFail()メソッド**を使用して$idのidを持ったデータを取得する。<br>

<span style="color: red;">idに該当するデータがない場合はエラーを返す。</span>**ここがfind()メソッドとの違いです。**<br>

③view関数とcompact関数を使用してshow.blade.phpに$tweet飛ばしている。

<br>
最後にViewに処理を書いていきます。<br>

<h2 style="color: orange;">View</h2>

既存である**index.blade.php**と新しく**show.blade.php**作成し、Controllerから受け取っている値を表示しましょう。<br>
<br>

```
// resources/views/tweets/index.blade.php

@extends('layout')

@section('content')
<div>
	{{-- 連想配列の形でも使える --}}
	{{-- foreachで全件取得 --}}
	@foreach($tweets as $tweet)
		<p>{{ $tweet->title }}</p>
	@endforeach
</div>
@endsection

===========================================

// resources/views/tweets/show.blade.php

@extends('layout')

@section('content')
<div>
	{{-- プロパティを使用。セミコロン不要 --}}
	<p>{{ $tweet->content }}</p>
</div>
@endsection
```

<br>


<h2 style="color: #33CC00;">やってみよう！</h2>

- 他のEloquentを試してみよう。
- 実在しないidとアクセスしてみてください。
- .envファイル内のAPP_DEBUGをfalseにして、`http://localhost:8000/tweets/{id}`に、実在しないidでアクセスしてみてください。


<h2 style="color: orange;">まとめ</h2>

- MVCのフローで値を取得、表示までできた。
- findOrFail()メソッド
	- ない場合にエラーが出る
- foreach()をblade上で使用することができました。
