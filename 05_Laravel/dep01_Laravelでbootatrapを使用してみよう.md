<h2 style="color: orange;">LaravelでBootstrapを使ってみよう</h2>
今までCSSを気にせず、何のデザインも施していないViewになっているのでCSSを入れていきましょう。<br>
ということで早速Laravelのプロジェクト内にBootstrapを導入してみましょう<br>


<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Laravel内でのBootstrap使用

<h2 style="color: orange;">Bootstrap導入</h2>

Bootstrapを導入する方法として色々な方法があります。<br>

今回はBootstrap CDN(コンテンツデリバリーネットワーク)を使用せず、**asset()関数**を使用し、publicディレクトリの中にダウンロードしたBootstrapを追加する。<br>

### asset関数
public直下のファイルのパスを示す時に使用
デフォルトではasset()は/public/以降を参照する

<br>
まず始めにBootstrapをプロジェクト内のpublicディレクトリ直下にコピーしましょう。<br>
用意するものは**CSSディレクトリ**と**JSディレクトリ**です。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/bootstrap_in_laravel.jpeg" style="width: 100%"><br>

コピーした後は読み込むだけ。<br>
layout.blade.phpにasset関数を使用し、cssとjsを読み込んでみましょう。<br>
<br>

```
// layout.blade.php

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Learn_SNS</title>
    {{-- Boostrap導入 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> // 追加
</head>
<body>
    @yield('content')
    {{-- Boostrap導入 --}}
    <script src="{{ asset('js/jquery-3.1.1.js') }}"></script> // 追加
    <script src="{{ asset('js/jquery-migrate-1.4.1.js') }}"></script> // 追加
    <script src="{{ asset('js/bootstrap.js') }}"></script> // 追加
</body>
</html>
```

<br>
読み込みがしっかりできているかViewでBootstrapを使用して確認してみましょう。<br>
<br>

```
// resources/views/tweets/index.blade.php

@extends('layout')

@section('content')
<div class="container">
	<div class="row">
	    <input type="button" class="btn btn-default" value="default"> // 追加
	    <input type="button" class="btn btn-success" value="success"> // 追加
	    <input type="button" class="btn btn-primary" value="primary"> // 追加
	    <input type="button" class="btn btn-info" value="info"> // 追加
	    <input type="button" class="btn btn-warning" value="warning"> // 追加
	    <input type="button" class="btn btn-danger" value="danger"> // 追加
	    <input type="button" class="btn btn-link" value="link"> // 追加

	    {{-- 連想配列の形でも使える --}}
	    {{-- foreachで全件取得 --}}
	    @foreach($tweets as $tweet)
	    	<p>{{ $tweet->title }}</p>
	    @endforeach
	</div>
</div>
@endsection
```

<br>
反映されていることがしっかりと確認できました。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/confirm_bs_in_laravel.png" style="width: 100%"><br>

<h2 style="color: orange;">まとめ</h2>

- asset関数を使用してpublicディレクトリにアクセス
- viewでbootstrap使用
