<h2 style="color: orange;">多対多のRelation</h2>
Part1でtinker上で動作を確認しました。<br>
Part2では、ツイートの新規投稿画面、編集画面から多対多のリレーションを扱いたいと思います。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>
- ツイートの新規作成、編集、表示
- タグ付与

<h2 style="color: orange;">Model</h2>
Tagのidの配列が取得できるように、`Tweet.php`を修正します。<br>
<br>

```
// app/Tweet.php

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Tweet extends Model
{
    protected $fillable = ['title', 'content', 'published_at'];

    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // 追加
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // 追加 $tweet->tag_list() でtagのidの配列が取得できるようになる。
    public function getTagListAttribute() {
        return $this->tags->lists('id')->all();
    }

}
```
<br>
`getTagListAttribute()アクセサ`を追加することで、$tweet->tag_list()でtagのidの配列が取得できるようにします。<br>
Modelにgetアクセサを設定する方法ですが、`getXxxxAttribute`という形式のメソッドを追加すれば、これがgetアクセサとして機能するようになっています。<br>
<br>
<h2 style="color: orange;">Controller</h2>
次にTweetsControllerを修正します。<br>
<br>

```
// app/Http/Controllers/TweetController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\Tag; // Tagモデルを使用するため追加
use Carbon\Carbon;

class TweetsController extends Controller
{
	public function __construct() // ログインをしていない時にログイン画面に送る方法
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index() {

    	// メソッドはタイムスタンプが新しい順にソートしてレコードを返します。orderBy( 'column', 'DESC' ) と同じ処理です。
    	$tweets = Tweet::latest('published_at')->published()->get(); // published()はModelで定義しているscopePublished

    	// dd($tweets);
    	return view('tweets.index', compact('tweets'));
    }

    public function create() { // ①
    	$tags = Tag::lists('name', 'id');

		return view('tweets.create', compact('tag');

    }

    public function show($id) {

    	$tweet = Tweet::findOrFail($id);

    	// dd($tweet);
    	return view('tweets.show', compact('tweet'));
    }

  	public function store(Request $request) { // ②

		$tweet = \Auth::user()->tweets()->create($request->all());
        $tweet->tags()->attach($request->input('tag_list'));

        $this->validate($request, $rules);

        Tweet::create($request->all());

        return redirect('tweets');
    }

    public function edit($id) { // ③
        $tweet = Tweet::findOrFail($id);
        $tweet->published_at = date('Y-m-d', strtotime($tweet->published_at)); // date関数formatを指定してdate関数の第二引数にstrtotimeで取り出せる型にしておく
        $tags = Tag::lists('name', 'id');

        return view('tweets.edit', compact('tweet'));
    }

    public function update($id, Request $request) { // ④
    	$tweet->tags()->sync($request->input('tag_list', []));
        $tweet = Tweet::findOrFail($id);

        $tweet->update($request->all());

        return redirect(url('tweets.show', [$tweet->id]));
    }

    public function destroy($id) {
        $tweet = Tweet::findOrFail($id);

        $tweet->delete();

        return redirect('tweets');
	}

}
```

<br>

### 解説
①create()メソッド内でTagの名前とidをViewに渡すよう修正しました。。<br>
②store()メソッドでは、リクエストで渡されるtag_listを`attach()メソッド`でTagのRelationに追加しています。<br>
③edit()メソッド内でTagとidの一覧をViewに渡すよう修正しました。<br>
④update()では、リクエストで渡されるtag_listをsync()メソッドでTagのリレーションに同期しています。<br>
sync()メソッドでは中間テーブルのデータが引数で渡された idの物だけになるように、追加と削除を行います。<br>
<br>
以上でControllerへの設定は完了です。<br>

<h2 style="color: orange;">View</h2>
ツイートの新規作成、編集で使用しているFormを修正します。<br>
<br>

```
// resources/views/tweets/form.blade.php

<div class="form-group">
    <label for="title">タイトル</label>
    <input type="text" class="form-control" name="title">
</div>
<div class="form-group">
    <label for="content">内容</label>
    <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
</div>
{{-- 追加 --}}
<div class="form-group">
    {!! Form::label('tag_list', 'Tags:') !!}
    {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control', 'multiple']) !!}
</div>
<div class="form-group">
    <label for="published_at">作成日</label>
    <input type="date" name="published_at" class="form-control" value="{{ $published_at }}">
</div>
<div class="form-group">
    <input type="submit" value="{{ $submitButton }}" class="btn btn-primary form-control">
</div>
```

<br>
selectTagを追加しました。先ほどTweetモデルに、getTagListAttribute()を追加したので、`tag_list`という属性名でFormと$tweetをバインドできます。<br>
selectTagは複数選択出来るようにする為、バインド名に括弧を付けて`tag_list[]`とし、オプションに`multiple`を入れています。<br>
<br>
次にツイート表示用のビューを修正します。<br>
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
		{{-- 追加 --}}
    	@unless ($article->tags->isEmpty())
	        <h5>Tags:</h5>
	        <ul>
	            @foreach($article->tags as $tag)
	                <li>{{ $tag->name }}</li>
	            @endforeach
	        </ul>
	    @endunless
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
ツイートにTagがあれば、Tag一覧を表示するように修正しました。<br>
これで、ツイートの新規作成、編集、表示でTagが扱えるようになりました。<br>
最後にしっかり動作確認しましょう。<br>

<h2 style="color: orange;">まとめ</h2>

- Laravelの一通りの流れができるようになりました。
