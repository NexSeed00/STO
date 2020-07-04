<h2 style="color: orange;">Viewに値を受け渡そう</h2>
作成したViewにControllerを使用して値を受け渡しそう！

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- about.blade.phpへControllerを通して自分の名前を表示

<h2 style="color: orange;">Controllerの設定</h2>
今回はすでにRoutingされているPagesControllerを使用してViewを値を渡します。<br>
PHPの**compact関数**を使って、下記のように書きます。compact関数はローカル変数から配列を生成します。<br>
<br>

```
// app/Http/Controllers/PagesController.php

<?php

namespace AppHttpControllers;

// ...

class PagesController extends Controller {

   	public function about() {

        // 変数に値をセット
        $first_name = 'Ichiro';
        $last_name = 'Suzuki';

        // view関数の第２引数に compact関数を使う
        return view('pages.about', compact('first_name', 'last_name'));
    }
}

```

<br>

compact関数内はシングルクォーテーションで囲み、**$** を外した変数名・配列名で記述します。<br>
compact関数を使わず、そのままview関数の第二引数に渡すこともできますが<br>
compact関数の方が応用範囲が広いため、値を受け渡す時はcompact関数と覚えても問題はないでしょう。<br>
<br>

そして、渡された値を表示する処理をViewに書いていきましょう。<br>
以前までViewで表示させるには、**<?php echo 値; ?>** と書いていましたが<br>
Laravelの場合、**{{ 値 }}** と書きます。下記のコードを見てみましょう。<br>
<br>

```
// resources/views/about.blade.php

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>About</title>
</head>
<body>
	<h1>About this page</h1>
	<h1>{{ $first_name }}・{{ $last_name }}</h1>
</body>
</html>
```

<br>

compact関数内は$が付いていませんでしたが、**実際にViewに記述する時は$を足して記述します。**<br>
<br>
ここまで書けたら **http://localhost:8000/about** にアクセスして表示を確認してみます。<br>
下記のような画面が表示されていれば成功です。このことからコントローラから渡された変数が使えていることがわかります。<br>
bladeではPHPで結果を表示する場合、**波括弧(ダブルカーリー) {{ }}** で囲みます。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/gavevalueto_about.png" style="width: 100%"><br>

<h2 style="color: orange;">まとめ</h2>

- Viewへの値の渡し方
	- compact関数を使う
- Viewで受け取った値を出力する方法
- bladeでのPHP表示方法は波括弧(ダブルカーリー) {{ }}
