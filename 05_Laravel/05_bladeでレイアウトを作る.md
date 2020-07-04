<h2 style="color: orange;">bladeでレイアウトを作る</h2>
今までaboutページ、contactページを作成してきました。<br>
お気付きの方はいるかもしれませんが、aboutページとcontactページに使われているHTMLはほとんど同じです。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>
- 共通している部分のみを切り出してレイアウトファイルを作成し、２つのページで共有できるようにしてみます。<br>

<h2 style="color: orange;">レイアウトのViewを作成</h2>
まず、レイアウトのViewを作成します。<br>
layout.blade.phpを作成し、下のコードを記述しましょう。<br>
<br>

```
// resources/views/layout.blade.php

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Learn_SNS</title>
</head>
<body>

    @yield('content')

</body>
</html>
```

<br>

bodyタグの中に **@yield(‘content’)** と記述しました。<br>
この部分が<span style="color: red;">実際のViewを表示する部分</span>になります。<br>
引数で渡している 'content' は **複数の@yieldがある場合に、場所を特定する為の名前**になります。

<h2 style="color: orange;">about.blade.phpの修正</h2>
layout.blade.phpを使用するためにresouces/views/pages/about.blade.phpを修正しましょう。<br>

```
<!-- 修正前 -->
// resouces/views/pages/about.blade.php

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>About</title>
</head>
<body>
	<h1>About this page</h1>
	<h1>{{ $first_name }}・{{ $family_name }}</h1>
</body>
</html>
```

<br>

```
<!-- 修正後 -->
resouces/views/pages/about.blade.php

@extends('layout')

@section('content')
    <h1>About this page</h1>
    <h1>{{ $first_name }}・{{ $family_name }}</h1>
@endsection
```

<br>

この場合、**@extendsの引数が “layout” になっているため、layout.blade.phpを継承するよう指示しています。**<br>
@sectionから@endsectionまでの部分が、layout.blade.phpの@yield('content')の部分になります。<br>
HTMLをごっそりと消して、layoutビューに移すことができました。これで layoutビューを他のビューからも使用することができます。<br>

<h2 style="color: #33CC00;"> やってみよう！</h2>
- contact.blade.phpもlayoutビューを使用するような記述をしてみましょう。

<h2 style="color: orange;">まとめ</h2>

- layout.blade.phpを作成し、Viewを統一
- @yieldの使い方や@extendsの意味
