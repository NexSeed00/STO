<h2 style="color: orange;">View Partialについて</h2>

今回は、記事の編集画面を追加します。編集画面のFormは新規登録画面のFormとほぼ同じな為、Viewの**Partial機能**を使って、Formを共通部品化してみたいと思います。<br>
ちなみにpartialを和訳すると`部分的な`という意味があります。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Formの部品化

<h2 style="color: orange;">Routing</h2>
まずは、Routingから。新しくRouteを追加します。<br>

```
// routes/web.php

Route::get('tweets/{id}/edit', 'TweetsController@edit');  // 追加
Route::patch('tweets/{id}', 'TweetsController@update');  // 追加
```

<br>
`TweetsController@edit`と`TweetsController@update`へのルートを追加しました。<br>
updateの方は**getではなくpatch**にしています。なぜ編集画面を作るのに二つのrouteを書く必要があるかというとそれぞれ役割が違います。<br>
簡単に説明すると`TweetsController@edit`は編集画面にアクセスする時、`TweetsController@update`は編集完了ボタンを押した時の動きです。<br>


<h2 style="color: orange;">Controller</h2>
新しくTweetsControllerにeditメソッドとupdateメソッドを追加します。<br>
<br>

```
// app/Http/Controllers/TweetsController.php

public function edit($id) {

    $tweet = Tweet::findOrFail($id);

    return view('tweets.edit', compact('tweet'));
}

public function update($id, Request $request) {

    $tweet = Tweet::findOrFail($id);

    $tweet->update($request->all());

    return redirect(url('tweets', [$tweet->id]));
}
```

<br>
editは今までに学んで内容で作成でき、特に新しい要素はありませんがupdateの方は、$idと$requestを引数で受け取っています。<br>
$requestは以前にやったFormRequestを継承した`Requestクラス`を使用しています。<br>FormRequestを使うことで、フォームの入力データのチェックとエラーがあった時の前画面へのリダイレクトを自動的に行なってくれます。<br>
updateメソッド内では$idに対応する記事を取得し、入力データで記事をupdateし、ツイート詳細画面(正規のルートだとshowメソッドから)にリダイレクトしています。

<h2 style="color: orange;">edit.blade.php作成</h2>
編集画面を作成するための**edit.blade.php**を作成します。<br>

```
// resources/views/tweets/edit.blade.php

@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<h1>Edit : {{ $tweet->title }}</h1>
		{{-- エラーの表示を追加 --}}
	    @if ($errors->any())
	        <div class="alert alert-danger">
	            <ul>
	                @foreach ($errors->all() as $error)
	                    <li>{{ $error }}</li>
	                @endforeach
	            </ul>
	        </div>
	    @endif

		<div class="col-md-6">
			<form action="/tweets/{{ $tweet->id }}" method="POST">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
				<div class="form-group">
					<label for="title">Tweet</label>
					<input type="text" name="title" class="form-control" value="{{ $tweet->title }}">
				</div>
				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" class="form-control">{{ $tweet->content }}</textarea>
				</div>
				<div class="form-group">
					<input class="form-control" name="published_at" type="date" value="{{ $tweet->published_at }}">
				</div>
				<div class="form-group">
					<input type="submit" value="編集完了" class="form-control btn-info">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
```
<br>
WWWブラウザではmethodはGETとPOSTにしか対応していないため、Laravelではhiddenを使って、`method="PATCH"`をエミュレートしています。<br>
現在のControllerの記述のままリクエストが行われるとツイート詳細画面に移動するので少しだけshow.blade.phpを整えたいと思います。<br>
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
         <a href="http://localhost:8000/tweets/{{ $tweet->id }}/edit" class="btn btn-info">編集する</a> // editボタンを追加
         <a href="http://localhost:8000/tweets/" class="btn btn-success">TOPへ戻る</a>
    </div>
</div>
@endsection
```

<h2 style="color: orange;">View Partial</h2>

記事の編集機能は実装できましたが、新規記事作成フォームと、記事編集フォームで同じコードが重複しているで、Viewの Partial機能を使ってリファクタリングしてみます。<br>
まず、一つ目はエラー表示のPartial化をしていくため、`form_errors.blade.php`を作成します。<br>
<br>

```
// resources/views/errors/form_errors.blade.php

@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
```

<br>
@includeを使って、form_errors.blade.phpを参照します。<br>
この`@include`はPHPでいう`include関数`にあたります。<br>
form_errors.blade.phpは `resources/views/errors`ディレクトリに作成した為、`errors.form_errors`と指定します。<br>
これを使用してedit.blade.phpを修正しましょう。<br>

```
@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<h1>Edit : {{ $tweet->title }}</h1>
		{{-- エラーの表示を追加 --}}
	   @include('errors.form_errors') // include関数を使用してerrors.form.errors.blade.phpを読み込んでいる。

		<div class="col-md-6">
			<form action="/tweets/{{ $tweet->id }}" method="POST">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
				@include('tweets.form', ['published_at' => $tweet->published_at, 'submitButton' => '編集完了'])
			</form>
		</div>
	</div>
</div>
@endsection
```

<br>
この様に、`@includeすることを目的に切り出したbladeテンプレートファイル`をLaravelでは**Partial**と呼んでいます。<br>

<h2 style="color: orange;">Form部分のpartial化と値の渡し方</h2>
formをpartial化するため、`form.blade.php`を作成します。<br>
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
<div class="form-group">
    <label for="published_at">作成日</label>
    <input type="date" name="published_at" class="form-control" value="{{ $published_at }}">
</div>
<div class="form-group">
    <input type="submit" value="{{ $submitButton }}" class="btn btn-primary form-control">
</div>
```

<br>
inputタグのpublished_atの初期値は、`$publishd_at`変数が渡されることを想定している処理になっています。<br>
また、submitボタンのタイトルも $submitButton変数が渡されるようになっています。<br>
つまり、formを使うものによって$published_atも$submitButtonも値が変わってきます。<br>
<br>
今度はform.blade.phpを使用するように、edit.blade.phpを修正します。<br>
<br>

```
// resources/views/tweets/edit.blade.php

@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<h1>Edit : {{ $tweet->title }}</h1>
		{{-- エラーの表示を追加 --}}
	   @include('errors.form_errors')

		<div class="col-md-6">
			<form action="/tweets/{{ $tweet->id }}" method="POST">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
				@include('tweets.form', ['published_at' => $tweet->published_at, 'submitButton' => '編集完了'])
			</form>
		</div>
	</div>
</div>
@endsection
```

<br>
`@include`を使って、form.blade.phpを参照する際に`published_at`と`submitButton`の値を引き渡しています。<br>
これでformのpartial化ができました。partial化と言っていますが、今までやってきたDB接続用の別ファイルを作り、require関数で読み込んでいることと何ら変わりないのです。<br>

<h2 style="color: #33CC00;">やってみよう！</h2>
- create.blade.phpもedit.blade.phpと同様に、partialを使うように修正してみてください。
- index.blade.phpにツイートをつぶやけるボタンとタイトルをクリックして詳細に飛べるような処理を書いてください。

<h2 style="color: orange;">まとめ</h2>

- Form部分のpartial化
- error文のpartial化
