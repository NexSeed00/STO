<h2 style="color: orange;">Scopeとは</h2>
FormRequestで、ツイートを投稿できるようになり、さらにエラー時のValidationを効かせることができるようになりました。<br>
が、まだいくつか問題点があります。<br>
１つは**新しい記事が下の方に表示されてしまうこと**、もう一つは、**公開日(published_at)を将来の日付に設定した場合でも表示されてしまうこと**です。<br>今回はこの２点を修正していきます。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Scopeについて
- メソッドチェインとは

<h2 style="color: orange;">ツイートをソートする</h2>
TweetsControllerを修正していきます。<br>
<br>

```
// app/Http/Controllers/TweetController.php

class TweetsController extends Controller
{
    public function index() {

    	// $tweets = Tweet::all();
    	$tweets = Tweet::latest('published_at')->get(); // ①

    	return view('tweets.index', compact('tweets'));
    }

...

}
```

<br>
### 解説

①**latest()メソッドはタイムスタンプが新しい順にソートしてレコードを返します。**<br>
SQL文で書いた`orderBy( 'column', 'DESC' )`と同じ処理です。また下記のようにも書くことができます。<br>

```
$tweets = Tweet::orderBy('published_at', 'desc')->get(); orderby()メソッドを使用している
```

<br>

### WHERE句を使用して現在時刻以前の記事のみ取得
次に公開日が現在時刻以前の記事だけを取得するように修正します。<br>
<br>

```
// app/Http/Controllers/TweetsController.php

use Carbon\Carbon; // 追加①

class TweetsController extends Controller
{
    public function index() {
        $tweets = Tweet::latest('published_at')->where('published_at', '<=', Carbon::now())->get(); // ②

        return view('tweets.index', compact('tweets'));
}

...

}
```

<br>
### 解説

①で日付処理などで有名な**Carbon**を使用しています。<br>**Carbon**とはPHPのDateTimeクラスをオーバーラップした日付操作ライブラリです。<br>
Laravelには元々組み込まれていますが、本来はGithubからcomposerを使用してインストールをするといった形が取られています。<br>
代表的なカーボンの使い方を見てみましょう。<br>

```
// 前提条件として現在時間が2018-06-04 18:00とします。

現在時刻や指定した日時の場合

$time = Carbon::now(); 現在時間
// 2018-06-04 18:00:00

$time = new Carbon('2018-06-04'); インスタンス化時に引数としてセットする
// 2018-06-04 00:00:00

$time = Carbon::today(); 今日の日付
// 2018-06-04 00:00:00

$time = Carbon::tomorrow(); 明日の日付
// 2018-06-05 00:00:00

$time = Carbon::yesterday(); 昨日の日付
// 2018-06-03 00:00:00

$time = Carbon::parse('2018-06-04 18:00:00'); // 指定した日付
// 2018-06-04 18:00:00
```

<br>
書き方は他にもたくさんあるライブラリなので調べてみるといいかもしれません。<br>

②上記で書いた`$tweets = Tweet::latest('published_at')->get();`のlatestメソッドとgetメソッドの間にwhereメソッドを使用しています。<br>
whereメソッドの使用方法は`where('カラム名', '記号', '値')`となります。<br>
このようにメソッドとメソッドがくっつくことを**メソッドチェイン**といいます。<br>

<h2 style="color: orange;">Scope機能</h2>
「公開日が現在時刻以前の記事」という条件は今後使用する回数が多くなることを見越して、EloquentのScope機能を使って、リファクタリングします。
Scope機能を使うにあたって下記の処理をする必要があります。<br>
### Scopeを使用するには
①Modelにscopeメソッドを追加。scopeを定義するにはメソッドの頭に`scope`を付けます。<br>
<br>

```
// app/Tweet.php

<?php

namespace App;

use Carbon\Carbon; // 追加
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['title', 'content', 'published_at']; // Eloquentのために追加

    //  published scopeを定義
    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

}
```

<br>
②Controllerでscopeを使用するようにコードを修正します。`where`を`scope`に差替え、名前をModelで記述した**scopeより後ろの名前を使用**する。<br>
<br>

```
$tweets = Tweet::latest('published_at')->published()->get(); // published()はModelで定義しているscopePublished
```

<br>
これでpublished()の再利用も簡単ですし、コードも読みやすくなりました。<br>

<h2 style="color: orange;">まとめ</h2>

- scopeの定義はModel内
- scopeに使用はController内
- 日付処理はCarbonクラスを使用するのが良い
