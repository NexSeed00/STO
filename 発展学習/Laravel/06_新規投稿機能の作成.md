# 新規投稿機能の作成
## 学ぶこと
このカリキュラムでは、新規投稿機能の作成を通して以下のことを学びます。  
1. ブラウザからURLを入力して、画面が表示されるまでの流れ(復習)
2. フォームからデータを送信する方法
3. データを保存する方法
4. バリデーションの方法

## ルートの設定
一覧の作成同様まずはルートの設定をします。  
ルートでは、**①どのURL(メソッドも含む)の時に**、**②どのコントローラーの**、**③どのメソッドを使用するか**  
を決めます。  


投稿画面と、保存処理のルートを追記してください。
```php
// routes/web.php
Route::get('/', 'DiaryController@index')->name('diary.index');

Route::get('diary/create', 'DiaryController@create')->name('diary.create'); // 投稿画面
Route::post('diary/create', 'DiaryController@store')->name('diary.create'); // 保存処理
```

## コントローラーの編集(投稿画面)
createメソッドを追加します。

```php
// app/Http/Controllers/DiaryController

    public function index()
    {
        //省略
    }

    public function create()
    {
        // views/diaries/create.blade.phpを表示する
        return view('diaries.create');
    }
```

## ビューの作成(投稿画面)
投稿画面にはDBのデータを表示する必要がないため、  
モデルでの処理はありません。 

投稿画面用のビューを作成します。
`resources/views/diaries/`ディレクトリに`create.blade.php`を作成して以下の内容をコピーしてください
。  

```php
// resources/views/diaries/create.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>新規投稿画面</title>
</head>
<body>
    <section class="container m-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route('diary.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" class="form-control" name="title" id="title" />
                    </div>
                    <div class="form-group">
                        <label for="body">本文</label>
                        <textarea class="form-control" name="body" id="body"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
```

以下のURLにアクセスして画面が正しく表示されることを確認しましょう。  
http://localhost:8000/diary/create

これで投稿画面は完成です。  
URLを入力して画面が表示されるまでの流れは、    
1. web.phpで使用するコントローラーとメソッドの確認
2. 1で指定されたコントローラーのメソッドを実行
3. 2で指定されたビューを表示する
となります。


画面は正しく表示されましたが、  
今回のビューには2箇所新しい書き方があるので簡単に紹介します。  
1. `<form action="{{ route('diary.create') }}" method="POST">`
2. `@csrf`

### フォームのactionに関して
まずはフォームのアクションに関して説明します。  
フォームのアクションには、遷移先のページのURLを入力することは  
既に認識されているかと思います。  

`action="{{ route('diary.create') }}" `も遷移先を指定してます。  
`route('diary.create')`と書くことこで、ルートに指定した`name`のURLに変換されます。  

```php
// routes/web.php
Route::get('/', 'DiaryController@index')->name('diary.index');

Route::get('diary/create', 'DiaryController@create')->name('diary.create'); // 投稿画面
Route::post('diary/create', 'DiaryController@store')->name('diary.create'); // 保存処理
```

上記が現在のルートです。  
それぞれ`>name('xxx.yyy')`となってますが、  
Laravelでは`<form>`や`<a>`で遷移先を指定するときに、`route('xxx.yyy')`とすることで、  
リンクが対応したURLになります。  

今回の場合は、`{{ route('diary.create') }}`なので、URLは`diary/create`となります。  
また、formに指定されているメソッドは`POST`のため、  
投稿ボタンを押した場合は保存処理が実行されることになります。


### CSRF対策
Laravelには一般的な攻撃を防ぐためのセキュリティ対策があらかじめ準備されています。  
そのうちの1つがCSRF対策です。  
CSRFの詳細は説明は本論とずれてしまうため割愛しますが、  
簡単にいうと、ユーザーの意図しない不正な書き込みなどが実施できる脆弱性、  
またはその脆弱性を利用した攻撃のことです。  

Laravelではその脆弱性を防ぐのは非常に簡単で、  
フォームの中に`@csrf`と記述するだけです。    
また、入力漏れがないように、`@csrf`を書いてない場合はフォームの送信時にエラーが表示されます。  

#### 参考リンク

[CSRF保護](https://readouble.com/laravel/5.7/ja/csrf.html)

## Controllerの編集(保存処理)
投稿画面ができたので、次は保存処理です。  
投稿画面の投稿ボタンを押してみましょう。  

エラーが表示されるかと思います。  

これはエラーの内容を読むとわかりますが、  
ルートで設定されている`DiaryController@store`が存在しないことが原因です。  

以下のようにstoreメソッドを追加してから再度投稿してみてください。
```php
//app/Http/Controllers/DiaryController
 public function create()
 {
     return view('diaries.create');
 }

public function store()
{
    dd('ここに保存処理');
}
```
画面が表示されるかと思います。  


次にControllerに以下2つの処理を追加します。  
1. データの保存(上4行)
2. 一覧画面にリダイレクトする(下1行)

```php
//app/Http/Controllers/DiaryController

public function store(Request $request)
{
    $diary = new Diary(); //Diaryモデルをインスタンス化

    $diary->title = $request->title; //画面で入力されたタイトルを代入
    $diary->body = $request->body; //画面で入力された本文を代入
    $diary->save(); //DBに保存

    return redirect()->route('diary.index'); //一覧ページにリダイレクト
}
```

一覧画面が表示され、入力した内容が表示されていれば保存の処理は成功です。 

投稿ボタンをクリックしてから、画面が表示されるまでの流れは、    
1. web.phpで使用するコントローラーとメソッドの確認
2. 1で指定されたコントローラーのメソッドを実行
3. モデルをインスタンス化→投稿内容の取得→投稿内容をDBへの保存
4. 一覧ページへリダイレクト
となります。

### ユーザーが入力した内容の取得
最後にユーザーが入力した内容ですが、  
`public function store(Request $request)`
の`$request`に入っています。  

`$request->formのname属性`とすることで、ユーザーが入力した内容を取得できます。  
例えば、`$request->title`とすることで、 ユーザーが入力したname属性titleの値が取得できます。  

### 参考リンク
- [Eloquent](https://readouble.com/laravel/5.7/ja/eloquent.html)
- [リクエスト](https://readouble.com/laravel/5.7/ja/requests.html)

## 一覧画面にリンクを追加

一覧画面から投稿画面に移動できるようにリンクを追加します
```php
// view/diaries/index.blade.php
<body>
<a href="{{ route('diary.create') }}" class="btn btn-primary btn-block">
    新規投稿
</a>
```

一覧画面から投稿画面に移動できることを確認しましょう。

## バリデーション
次にバリデーションを行います。  
バリデーションとはユーザーが入力した内容が適切か検証を行うことです。   
不適切な場合は、必要に応じて警告などを表示します。  

不適切な場合とは例えば、  
- 必須入力欄なのに、空欄
- パスワードが短い
- パスワードが間違っている
- 年齢を入れる欄に文字が入っている
などです。

皆さんも一度はログインやアカウント登録で、  
エラーを表示したことがあるのではないでしょうか。  
不適切な値が入力された場合は、  
ユーザーが適切な値を入力できるように警告などを表示します。

現在文字を何も入力せずに投稿ボタンを押すと、エラーが表示されるかと思います。  
これはDBでは日記のタイトルなどが空になることを許可してないのに、  
空で保存しようとしているためエラーが表示されています。  

### 設定するバリデーション
日記はタイトルも本文も必ず入力してもらいたいので、  
入力を必須とします。

バリデーションをする方法はいくつかありますが、  
ここではそのうちの1つを紹介します。  

大まかな流れとしては以下です。
1. バリデーションを記述するファイルを作成
2. 1にバリデーションの条件を記述
3. 1で作成したファイルを対象のメソッドで使用
4. 画面に警告を表示する

### 参考リンク
[バリデーション](https://readouble.com/laravel/5.7/ja/validation.html)

#### バリデーションを記述するファイルを作成

以下のコマンドを実行するだけです。  
`php artisan make:request CreateDiary`

`app/Http/Requests`に`CreateDiary`というファイルが作成されます。  


### バリデーションの条件を記述

ファイルを以下のように修正します。  
```php
// app/Http/Requests/CreateDiary

class CreateDiary extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // falseから変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:30', 
            'body' => 'required',
        ];
    }
}
```

`rules()`メソッドにバリデーションのルールを記述します。  
今回は、フォームのname属性が`title`の場合は、  
入力必須(`required`)と、最大30文字(`max:30`)を設定してます。 


### バリデーションのファイルを対象のメソッドで使用

```php
// app/Http/Controllers/DiaryController

use App\Http\Requests\CreateDiary; // 追加

class DiaryController extends Controller
{
        // 中略

public function store(CreateDiary $request) //変更
{

}
```

文字を何も入力しないで投稿ボタンを押すと元の画面にもどります。  
これはstoreメソッドを実行する前に、CreateDiaryクラスに記述したバリデーションを実行しているためです。  

これでバリデーションはできるようになりましたが、  
画面に何も表示されないため、  
ユーザーには何がおこったかわからず不親切です。  


### ビューにエラーメッセージを表示

以下のif文を追加してください。  
```php
// resources/views/diaries/create.blade.php

@if($errors->any())
   <ul>
       @foreach($errors->all() as $message)
            <li class="alert alert-danger">{{ $message }}</li>
       @endforeach
   </ul>
@endif
<form action="{{ route('diary.create') }}" method="post">
```

Laravelではバリデーションのエラーは全て$errorsという変数に入るため、  
$errorsから`foreach`で全てのエラーを取り出して表示してます。  

### 入力内容の保持
エラーで元の画面に戻った後に、入力内容を1から入力し直すのは面倒です。
そのため、入力内容を保持できるようにします。
`old(name属性)`と入力するだけです。  

```php
// resources/views/diaries/create.blade.php

<input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">

<textarea class="form-control" name="body" id="body">{{ old('body') }}</textarea>
```

## まとめ
これで新規投稿機能の作成は完了です。
このカリキュラムでは、以下の4つを学びました。  
1. ブラウザからURLを入力して、画面が表示されるまでの流(復習)
2. フォームからデータを送信する方法
3. データを保存する方法
4. バリデーションの方法

新しい内容が非常に多かったと思いますが、暗記する必要はありません。
**大まかにこういうことができる**ということ だけ覚えておけば、  
細かい書き方は、実際に書くときに調べれば問題ありません。  



## おまけ
### エラーメッセージの日本語化
エラーメッセージはデフォルトだと英語ですが、日本語化もできます。  

- `/resources/lang/jp`ディレクトリを作成
- `/resources/lang/en/validation.php`を`/resources/lang/jp/`にコピー
- 必要な箇所を日本語に編集
    
```php
// validation.php

'required' => ':attribute は必須です。',
'string' => ':attribute は :max 文字以内にしてください。', //81行目
```

```php
// config/app.php

'locale' => 'jp', //localeをjpに変更
```

```php
// app/Http/Requests/CreateDiary

// 追加
public function attributes()
{
    return [
        'title' => 'タイトル',
        'body' => '本文',
    ];
}
```

`attributes()`メソッドでは、バリデーションで失敗した際に警告文として使用する文字を指定します。  
`attributes()`を指定しない場合、警告に使用される文字はname属性になります。 


最後に投稿ボタンを押した時のエラー内容が日本語になってることを確認します。
