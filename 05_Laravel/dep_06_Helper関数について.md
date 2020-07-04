<h2 style="color: orange;">Helper関数とは</h2>
Laravelには、`ヘルパー関数（Helper Functions）`という、便利なグローバル関数が複数定義されています。<br>

この**ヘルパー関数**の多くはフレームワーク自体で使用されていますが、ユーザーがアプリケーションに含むこともでき、自由に使用できることも特徴の一つです。<br>
今回はヘルパー関数の作成も行いながら、ツイートの削除機能を追加していきます。<br>

### <span style="color: red;">注意！！！</span>

**このカリキュラム内で使用しているHelper関数は`laravelcollective/html`というパッケージを追加していなくてはできませんのでご注意ください。**<br>
詳しくは<a href="http://hackers.nexseed.net/curriculums/168">laravelCollective導入方法</a>へ。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Helper関数の使い方
- ツイートの削除機能(DELETE)
- Autoload設定

<h2 style="color: orange;">Routing</h2>
おきまりのRouting設定。下記を追加しましょう。<br>
<br>

```
// app/Http/routes.php

Route::delete('tweets/{id}', 'TweetsController@destroy');  // 追加
```

<br>
TweetsController@destroyへのルートを追加します。メソッドはdelete。<br>

<h2 style="color: orange;">Controller</h2>
次におきまりのControllerへメソッド追加。<br>
<br>

```
// app/Http/Controllers/TweetsController.php

public function destroy($id) {
        $tweet = Tweet::findOrFail($id);

        $tweet->delete(); // ①

        return redirect('tweets');
}
```

<br>
①$idでツイートを検索し、delete()メソッドで削除しています。<br>

<h2 style="color: orange;">View</h2>
最後におきまりのViewの修正。ツイートの詳細画面に、削除ボタンを追加します。<br>
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
		<a href="http://localhost:8000/tweets/{{ $tweet->id }}/edit" class="btn btn-info">編集する</a>
		<a href="http://localhost:8000/tweets/{{ $tweet->id }}" class="btn btn-danger">削除する</a> // 追加
		<a href="http://localhost:8000/tweets/" class="btn btn-success">TOPへ戻る</a>
	</div>
</div>
@endsection
```

<br>
DELETEをリクエストするFormを作成し、削除ボタンを追加しました。これでツイートの削除は出来るようになりました。<br>

<h2 style="color: orange;">Helper</h2>
DELETEをリクエストするFormの作成部分をヘルパー関数として切り出してリファクタリングしてみます。<br>
新規に`helper.php`を作成します。Formタグを生成して返信する`delete_form()関数`を追加します。<br>
<br>

```
// app/Http/helper.php

<?php

function delete_form($urlParams, $label = '削除')
{
    $form = Form::open(['method' => 'DELETE', 'url' => $urlParams]);
    $form .= Form::submit($label, ['class' => 'btn btn-danger']);
    $form .= Form::close();

    return $form;
}

?>
```

<br>
### Autoload設定
helper.phpを作成後、そのファイルを読み込ませるために`composer.json`というファイルを使用して自動ロードされるようにしていきます。<br>
<br>

```
// composer.json

{
...
"autoload": {
        "classmap": [
            "database"
        ],
        "psr-4": {
            "App\\": "app/"
        },
        "files": ["app/Http/helper.php"]
},
...
}
```

<br>
`composer.json`の自動ロード設定を変更した後は以下のCUI上でコマンドを使用し、設定を反映する必要があります。<br>
<br>

```
composer dump-autoload
```

<br>
上記コマンド入力後、画面に`Generating autoload files`で出れば成功です。<br>
<h2 style="color: orange;">Helperの使用</h2>
上記で作成したdelete_form()を使用するように、show.blade.phpを修正します。<br>
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
		<a href="http://localhost:8000/tweets/{{ $tweet->id }}/edit" class="btn btn-info">編集する</a>
		{{-- <a href="http://localhost:8000/tweets/{{ $tweet->id }}" class="btn btn-danger">削除する</a> --}}
		{!! delete_form(['tweets', $tweet->id]) !!} // 修正
		<a href="http://localhost:8000/tweets/" class="btn btn-success">TOPへ戻る</a>
	</div>
</div>
@endsection
```

<br>
`delete_formヘルパー`を使ったことで、大分スッキリしました。また、delete_formヘルパーはツイート以外にも削除が必要になった時には再利用が可能という利点があります。<br>


<h2 style="color: orange;">まとめ</h2>

- helper関数の使い方
- `composer dump-autoload`の使い方
- composer.jsonへの書き方、反映方法
