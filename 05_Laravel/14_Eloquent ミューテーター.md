<h2 style="color: orange;">Eloquent ミューテーター</h2>

Eloquentはモデルの属性を設定・取得する時に、設定・取得した内容を変更できる機能があります。<br>
この属性内容を変換するメソッドを<span style="color: red;">ミューテーターと呼びます。</span><br>
ミューテーターは二つあり、**getミューテーター**と**setミューテーター**があります。<br>
このカリキュラムでは、そのミューテーターに触れていきたいと思います。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- ミューテーターとは
- ミューテーターの役割
- 日付ミューテーターについて

<h2 style="color: orange;">getミューテーターとsetミューテーター</h2>

### getミューテーター
getミューテーターのメソッド名は、`get属性名Attribute()`とします。<br>
**属性名はテーブルの項目名がスネークケースで命名されていても、キャメルケースで記述する必要がある**ので注意してください。

```
<!-- app\Tweet.php -->

class Tweet extends Model
{
    ...

    public function getTitleAttribute($value)
    {

        return mb_strtoupper($value); // mb_strtoupper関数がメソッド内の値を大文字に変換することができる
    }

}
```

### setミューテーター
メソッド名は、`set属性名Attribute()` とします。<br>

```
<!-- app\Tweet.php -->

class Tweet extends Model
{
    ...
 
    public function setTitleAttribute($value)
    {

        $this->attributes['title'] = mb_strtolower($value); // mb_strtolower関数がメソッド内での文字を小文字に変換することができる
    }
 
}
```

<h2 style="color: orange;">日付ミューテーター</h2>
Elocuentにはデフォルトで日付ミューテーターが備わっています。<br>
**created_at, updated_at **属性はPHPのDateTimeを拡張したCarbonのインスタンスに変換されます。<br>
**日付ミューテーターを使用する属性をEloquentに知らせるには、dates配列に属性名を追加**します。<br>

```
class Tweet extends Model
{
    ...
 
    // published_at で日付ミューテーターを使う
    protected $dates = ['published_at'];
 
    ...
}
```

<br>
このように書くことで前までただの文字列のpublished_atになっていた部分がCarbon仕様になるという便利な機能です。<br>
下記を参考に比較してみてください。<br>
<br>
**published_at を日付ミューテーターに指定する前**
<br>

```
>>> $tweet = App\tweet::first();
>>> $tweet->published_at
=> "2018-05-30 10:22:54"   // ただの文字列
>>> $tweet->published_at = "2018-05-30 11:00:00"
=> "2018-05-30 11:00:00"
>>> $tweet->published_at
=> "2018-05-30 11:00:00"   // ただの文字列
>
```

<br>
**published_at を日付ミューテーターに指定する後**
<br>

```
>>> $tweet = App\Tweet::first();
>>> $tweet->published_at
=>  {    // Carbonの形に
       date: "2018-05-30 11:00:00",
       timezone_type: 3,
       timezone: "UTC"
   }
>>> $tweet->published_at = "2015-02-24 11:00:00"
=> "2015-02-24 11:00:00"
>>> $tweet->published_at
=>  {    // Carbonの形に
       date: "2018-05-30 11:00:00",
       timezone_type: 3,
       timezone: "UTC"
   }
>
```


<h2 style="color: orange;">まとめ</h2>

- getミューテーターとsetミューテーター
- Carbonクラスを文字列からCarbonの形に変えられる
