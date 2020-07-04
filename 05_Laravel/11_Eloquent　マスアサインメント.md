<h2 style="color: orange;">マスアサインメントとは</h2>
マスアサインメントとは、**自動でデータベースにデータを追加してくれる便利な機能のこと**です<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>
- マスアサインメントについて
- マスアサインメントの使用方法
- マスアサインメントのセキュリティー

<h2 style="color: orange;">マスアサインメントの使用方法</h2>
Eloguent のマスアサインメント機能を使って、テーブルにデータを追加してみます。<br>
**create() メソッド**に配列で値を渡すことで、１文でテーブルにデータを追加することができます。<br>
<br>
ここからはphp artisan tinkerを使用していきます。下記のコマンドを入力しましょう。<br>
<br>

```
<!-- プロジェクト直下で実行 -->

php artisan tinker

Psy Shell v0.7.2 (PHP 7.1.1 — cli) by Justin Hileman
>>> App\Tweet::create(['title'=>'hogehoge', 'content'=>'fugafuga', 'published_at' => Carbon\Carbon::now()]);
```

<br>
するとこんなエラーメッセージが出現します。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/elo_massassignment1.png" style="width: 100%"><br>
<br>
このエラーの原因として<span style="color: red;">Eloquentのマスアサインメントでは**事前に登録できるカラムを宣言しておく必要があります。**</span><br>
下記のように**モデル内に fillable 変数を用意し、配列の形で宣言します。**<br>
<br>

```
<!-- app/Tweet.php -->

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['title', 'content', 'published_at']; // 追加
}
```

<br>
そして、先ほどtinker上で入力したコマンドを再度入力すると配列の形でデータが作成され、自動的にDBへ追加されます。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/elo_massassignment2.png" style="width: 100%"><br>

<h2 style="color: orange;">マスアサインメントの使用方法</h2>
では何故マスアサインメントでは、このように **fillable** を使って、ガードする必要があるのでしょうか？<br>
<br>
マスアサインメントは、ユーザからのリクエストをテーブルに保存する処理で使用されます。<br>リクエストに想定していないカラムが含まれていた場合、そのまま更新されてしまうと、重大なセキュリティーホールとなってしまうためです。<br>
<br>
例えばUserクラスに<br>
`name, age, admin`
<br>の3カラムがあり、adminはユーザーの画面からは更新させない管理者権限だとします。<br>
<br>
Userの新規登録処理で、以下のようなコードを書いていた場合…<br>
<br>

```
$tweet = App\User::create($request->all());
```

<br>
不正リクエストなどによって$requestにadminが含まれていた場合、管理者権限を任意の値に設定されてしまいます。<br>
その為、マスアサインメントでは fillableで宣言したカラムのみに許可を与え、それ以外をガードしているのです。<br>

<h2 style="color: orange;">まとめ</h2>

- マスアサインメントを使用する際はfillableで事前に登録できるカラムを宣言しておく必要がある。
- fillableを使う理由はマスアサインメントを使用した際の不正アクセスを防ぐため
