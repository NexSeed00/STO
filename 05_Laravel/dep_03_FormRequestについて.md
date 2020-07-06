<h2 style="color: orange;">FormRequest</h2>

Laravelにある機能の一つ、**FormRequestという機能**を使って、入力値のチェックをリファクタリングしてみたいと思います。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- FormRequestでのリファクタリング
- バリデーション

<h2 style="color: orange;">バリデーション</h2>
Formを作成してTweetsテーブルにデータを追加しましたが、入力データのチェックを行っていませんでした。<br>
今回はこの入力データのチェック、つまりバリデーションを実装してみます。<br>

### storeメソッドを編集
Formで入力されたデータを保存している、storeメソッドを修正します。<br>
<br>

```
// app/Http/Controllers/TweetsController.php

<?php

namespace AppHttpControllers;

use App\Http\Controllers\Controller;
use App\Tweet;

use Illuminate\Http\Request;  // ①

class TweetsController extends Controller {

    // ...

    public function store(Request $request) {  // ①

        $rules = [    // ②
            'title' => 'required|min:3',
            'content' => 'required',
            'published_at' => 'required|date',
        ];

        $this->validate($request, $rules);  // ③

        Tweet::create($request->all());

        return redirect('tweets');
    }
}
```

<br>
### 解説
①リクエストの取得方法を変更しました。<br>
前回は **\Requestファサード**を使って、リクエストにアクセスしましたが、今回はstoreメソッドの引数から<br>
`Illuminate\Http\Request`<br>
クラスのインスタンスを取得するようにしました。<br>
Laravelのコントローラーはメソッドの**引数(Request $requestのこと)**にタイプヒントでクラスを記述するだけでそのクラスのインスタンスを自動生成して値を渡してくれます。<br>
<br>
②バリデーションルールを設定しています。<br>
バリデーションルールの詳細は公式ドキュメントを参照してください。<br>
<a href="https://laravel.com/docs/5.1/validation#available-validation-rules"> 公式ドキュメント </a><br>
<br>
③コントローラの **validate()メソッド** を実行しています。<br>
リクエストした内容にエラーがあると、自動的に前の画面にリダイレクトしてくれます。<br>
なんて便利なんだ...<br>

### エラー内容をViewに表示
上でエラー時の処理はかけました。あとはエラーを画面に表示させます。<br>
上記でエラーが起きた場合のエラーメッセージは**$errors**という配列に複数格納しています。<br>
$errors配列に格納されている`@foreach`を使って件数分表示します。<br>
<br>
```

// reosources/views/tweets/create.blade.php
@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <h1>ツイートを投稿</h1>
        {{-- エラーの表示を追加 --}} // 追加 ここから
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    	@endif // 追加 ここまで

       <div class="col-md-6">
            <form action="{{ url('/tweets') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Tweet</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" class="form-control" placeholder="ツイートを入力してください"></textarea>
                </div>
                <div class="form-group">
                    <input class="form-control" name="published_at" type="date">
                    <input type="submit" value="ツイートする" class="form-control btn-info">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
```

<br>
### 動作確認
<a href="http://localhost:8000/tweets/create">http://localhost:8000/tweets/create </a>にアクセスし、何も入力しないままツイートしてください。<br>
下記のような表示が出れば成功です。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/validation_laravel.png" style="width: 100%"><br>
<br>

<h2 style="color: #33CC00;">やってみよう！</h2>
- 全ての項目を入力し正常に記事が登録されることも確認してみましょう。

<h2 style="color: orange;">FormRequestのリファクタリング</h2>
artisanコマンドを使用して、Tweet用のFormRequestを生成します。<br>
<br>

```
php artisan make:request TweetRequest
```

<br>
実行すると<br>
<br>

```

// app/Http/Requests/TweetRequest.php

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TweetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
```

<br>
TweetRequest.phpが作成されました。<br>
このあと、このファイルをいじってリファクタリングしていきます。<br>

### TweetRequest.phpを修正

```
// app/Http/Requests/TweetRequest.php

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TweetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // ①
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ // ②
            'title' => 'required|min:3',
            'content' => 'required',
            'published_at' => 'required|date|after:tomorrow', // ③
        ];
    }
}
```

<br>
①authorizeメソッドではリクエストに対する権限を設定します。<br>
例えば、現在ログイン中のユーザに権限が無ければ**false**を返します。<br>
今のところ誰でもTweetsデータを追加できるように**true**を返しておきます。<br>
<br>
②rules()メソッドでは名前の通り、バリデーションのruleを返しています。<br>
③明日以降の日付の投稿ができないようにバリデーションしている。<br>

### TweetsControllerの修正
TweetsController.phpのstoreメソッドで**TweetRequest**を使うように修正していきます。
<br>

```
// app/Http/Controllers/TweetsController.php

<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\Http\Controllers\Controller;

use App\Http\Requests\TweetRequest;  // ①

class TweetsController extends Controller {

    // ...

    public function store(TweetRequest $request) {  // ①

        // ここでの validate が不要になった

        Tweet::create($request->all());

        return redirect('tweets');
    }
}
```

<br>
①storeメソッドで受け取るクラスを `Illuminate\Http\Request` から `App\Http\Requests\TweetRequest` に変更しました。<br>
この処理のみで今までstoreメソッド内で行っていたvalidateが不要になります。<br>
エラーがあった時の前画面へのリダイレクトも TweetRequestが行ってくれますし、Controller内もスッキリし、ハッピー。<br>

<h2 style="color: orange;">まとめ</h2>

- php artisan make:request
	- FormRequestが作成できる
	- ユーザー権限がないユーザーはリダイレクトしてくれる
  

<h2 style="color: #33CC00;">やってみよう！</h2>
- 今まで通り入力チェックが効くか、動作確認しておきましょう。
- エラーメッセージの日本語化

①まず`config/app.php`の **locale を ja に変更**します。<br>
②次にエラーメッセージを格納しているファイル`validation.php`を開きます。初めは日本語のファイルは存在しないので、英語のファイルをコピーして作成します。<br>
resources/lang/直下にja(japanese)ディレクトリを作成し、resources/lang/en/validation.phpをresources/lang/ja直下にコピーしましょう。<br>
③ja/validation.php の内容を日本語に修正します。<br>
<br>

```
// resources/lang/ja/validation.php

<?php
 
return [
 
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */
 
    "date" => ":attributeは正しい日付ではありません。",
    "min" => [
        "string"  => ":attributeは:min文字以上入力してください。",
    ],
    "required" => ":attributeを入力してください。",
 
    // ...
 
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */
 
    'attributes' => [
        'title' => 'タイトル',
        'content' => '本文',
        'published_at' => '公開日',
    ],
];
```

<br>
これで、該当するエラーの場合、日本語のエラーメッセージが表示されるようになります。<br>
