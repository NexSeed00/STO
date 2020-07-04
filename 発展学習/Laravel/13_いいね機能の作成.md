# いいね機能の作成

## 学ぶこと
ここではいいね機能の作成を通して、  
1. LaravelでのAjaxの使用方法
2. 多対多のリレーション
の2つを学びます。  

## 手順
大まかに以下の流れで作業を実施します。  
1. テーブルの作成
2. リレーション
3. ルートの設定
4. いいねボタンの作成
5. いいね機能
6. いいね解除機能
7. 一覧画面を表示した際のボタンの表示切り替え


## テーブルの作成
まずは、いいねされたデータを保存するためのテーブルを作成します。  

以下のコマンドを実行します。  
` php artisan make:migration create_likes_table --create=likes`


このテーブルでは、**誰が**、  **どの投稿を** いいねしたかを管理します。   
そのため、作成されたファイルを以下のように修正します。  

```php
// database/migirations/yyyy_mm_dd_xxxxxx_create_likes_table

Schema::create('likes', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('diary_id');
    $table->integer('user_id');
    $table->timestamps();
});

php artisan migrate

```

## リレーション
テーブルが追加されたため、追加されたテーブルも含めた関係性をモデルで表します。  

今存在するテーブルは、
- ユーザーを表す`users`テーブル
- 日記を表す`diaries`テーブル
- いいねを表す`likes`テーブル
です。  

InstagramやTwitterなどのSNSを考えてもらうとわかりやすいですが、  
ユーザーはたくさんの投稿(日記)に対して**いいね**ができます。  

また、 日記は複数のユーザーから**いいね**される可能性があります。  

このような関係性を多対多といいます。  
そして、今回の**いいね**を表す`likes`テーブルのような、間にはいるテーブルを**中間テーブル**といいます。  

コードに表すと以下のようになります。  
これは、`diaries`テーブルと`users`テーブルが、`likes`テーブルを中間テーブルとした、  
多対多の関係であることを表しています。  

```php

// app/Diary.php

class Diary extends Model
{

    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

}

```

### 参考リンク
[多対多 | リレーション](https://readouble.com/laravel/5.7/ja/eloquent-relationships.html#many-to-many)


## ルートの設定
いいねを記録するDB周りのコードを書き終えたため、次はルートを定義します。  
いいね機能と、いいね解除で別のルートを用意しておきます。  
いいね機能はログインユーザーのみの機能のため、  
`Route::group(['middleware' => 'auth']`の中に書きます。  

```php

// routes/web.php

Route::group(['middleware' => 'auth'], function() {
    
    // 省略

    Route::post('diary/{id}/like', 'DiaryController@like');
    Route::post('diary/{id}/dislike', 'DiaryController@dislike');
});

```

## いいねボタンの作成
次に画面にいいねボタンを表示します。  
「いいね」という文字でも問題ないですが、  
ここではTwiiterやFacebookのようにアイコンを表示します。

### Font Awesome
Font Awesomeとは、FacebookやTwitterなどの色々なアイコンを簡単に使用することができるツールです。  
アイコンを文字として扱えるため、大きさや色を自分のWebサイトに合わせて変更できます。  

以下のように読み込むことで、指定されたクラスをつけるとアイコンが表示されます。  
```php
// resources/views/layouts/app.blade.php

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

```

#### 参考リンク
[Font Awesome](https://fontawesome.com/)


### ボタンの追加
編集、削除ボタンの下にいいねボタンを追加します。  

```php
// resources/views/diaries/index.blade.php

@if (Auth::check() && Auth::user()->id === $diary->user_id)
   // 省略
@endif
<div class=" mt-3 ml-3">
    <i class="far fa-heart fa-lg text-danger js-like"></i>
    <input class="diary-id" type="hidden" value="{{ $diary->id }}">
    <span class="js-like-num">200</span>
</div>

```

`<i class="far fa-heart fa-lg text-danger js-like"></i>`でFont Awesomeを使用してハートのアイコンを表示してます。  
※`text-danger js-like`はFont Awesomeとは関係ないクラスです。

## いいね機能
次にいいねボタンが押された時の処理を記述します。  
いいねボタンが押された時は、画面遷移をしたくないため、Ajaxを使用します。  


### JavaScript/jQueryの読み込み
Ajaxを使用するため、jQueryとJSのファイルを読み込みます。  

まずは`diary.js`という名前のファイルを`public/js`に作成します。

`resources/views/layouts/app.blade.php`でJSを読み込んでいる箇所があるため、  
そこに以下のを記述します。  

```php
// resources/views/layouts/app.blade.php

// jQueryの読み込み
<script src="https://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js" defer></script> // 追加
<script src="{{ asset('js/app.js') }}" defer></script>
 // JSの読み込み
<script src="{{ asset('js/diary.js') }}" defer></script> // 追加

```

### いいねボタンの動作確認
JSのファイルも準備できたため、ボタンの動作確認をします。  

以下のコードを追加した後、いいねボタンをクリックしてみましょう。  
コンソールに`ボタンがクリックされました。`と表示されれば正常に動作しています。  

```JavaScript
// public/js/diary.js

$(document).on('click', '.js-like', function() {
    console.log('ボタンがクリックされました。');
});

```

### サーバへのデータ送信
ボタンを押した時に正しくJavaScriptのコードが動くことを確認できたので、  
実際にいいねする時のコードを書きます。  


```JavaScript

$(document).on('click', '.js-like', function() {
    let diaryId = $(this).siblings('.diary-id').val();

    let $clickedBtn = $(this);

    like(diaryId, $clickedBtn);
})

function like(diaryId, $clickedBtn) {
    $.ajax({
        url: 'diary/' + diaryId +'/like', 
        type: 'POST', 
        dataTyupe: 'json',
        // LaravelではCSRF対策として、tokenを送信しないとエラーが発生します。
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(
        function (data) {
            changeLikeBtn($clickedBtn);
            
            // いいね数を1増やす
            let num = Number($clickedBtn.siblings('.js-like-num').text());
            $clickedBtn.siblings('.js-like-num').text(num + 1);
        },
        function () {
            console.log(error);
        }
    )
}

// いいね, いいね解除でボタンの色を変更、
// js-like, js-dislikeでいいね, いいね解除の切り替えをしてるためクラスの付け替え
function changeLikeBtn(btn) {
    btn.toggleClass('far').toggleClass('fas');
    btn.toggleClass('js-like').toggleClass('js-dislike');
}

```

### サーバでの処理
ルートは事前に設定済みなのでコントローラーでの処理を書きます。  

```php
// app/Http/Controllers/DiaryController

public function like(int $id)
{
    $diary = Diary::where('id', $id)->with('likes')->first();

    $diary->likes()->attach(Auth::user()->id);
}

```

これで以下のことが確認できます。
1. likesテーブルにデータが作成される。  
2. いいねのハートマークに色がつく
3. いいね数が増加する。

### いいね数の表示数修正
画面のいいね数に正しいいいね数が表示されるように修正します。  


`App\Diary`に`likes()`という名前で、リレーションを表すメソッドを使用しているため、  
`Diary::with('likes')`のようにして、関連するテーブルのレコードを取得できます。  

```php

// app/Http/Controllers/DiaryController

public function index()
{
  $diaries = Diary::with('likes')->orderBy('id', 'desc')->get(); //修正

  return view('diaries.index',[
      'diaries' => $diaries,
  ]);
}

```

```php

// resources/views/diaries/index.blade.php

<input class="diary-id" type="hidden" value="{{ $diary->id }}">
<span class="js-like-num">{{ $diary->likes->count() }}</span> // 修正

```

count()を使用することで、今回の場合は、  
紐づいてるレコード数を取得していいね数を表示してます。  

#### 参考リンク
[count() | コレクション](https://readouble.com/laravel/5.7/ja/collections.html#method-count)

## いいね解除機能

### サーバへのデータ送信

```JavaScript
// public/js/diary.js

// いいね解除ボタンが押されたとき
$(document).on('click', '.js-dislike', function() {
  let diaryId = $(this).siblings('.diary-id').val();

  let $clickedBtn = $(this);

  dislike(diaryId, $clickedBtn);
})


// いいね解除処理
function dislike(diaryId, $clickedBtn) {
  $.ajax({
      url: 'diary/' + diaryId +'/dislike',
      type: 'POST',
      dataTyupe: 'json',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  })
  .then(
      function (data) {
          changeLikeBtn($clickedBtn);

          // いいね数を1減らす
          let num = Number($clickedBtn.siblings('.js-like-num').text());
          $clickedBtn.siblings('.js-like-num').text(num - 1);
      },
      function () {
          console.log(error);
      }
  )
}


```

### サーバでの処理
ルートは事前に設定済みなのでコントローラーでの処理を書きます。

```php

// app/Http/Controllers/DiaryController

public function dislike(int $id)
{
    $diary = Diary::where('id', $id)->with('likes')->first();

    $diary->likes()->detach(Auth::user()->id);
}

```

これで以下のことが確認できます。
1. likesテーブルからデータが削除される。  
2. いいねのハートマークから色が消えます。
3. いいね数が減少する。

## 一覧画面を表示した際のボタンの表示切り替え
最後にページを表示した時にいいねされてる場合は、いいね済み、  
いいねされてない場合はいいね、  
となるようにボタンを切り替えます。  

```php
// resources/views/diaries/index.blade.html

<div class=" mt-3 ml-3">
   @if (Auth::check() && $diary->likes->contains(function ($user) {
       return $user->id === Auth::user()->id;
   }))
       <i class="fas fa-heart fa-lg text-danger js-dislike"></i>
   @else
       <i class="far fa-heart fa-lg text-danger js-like"></i>
   @endif
   <input class="diary-id" type="hidden" value="{{ $diary->id }}">
   <span class="js-like-num">{{ $diary->likes->count() }}</span>
</div>

```

記述できたらページを表示して、いいねボタンが押されてる日記と、  
押されていない日記でいいねボタンの表示が異なることを確認しましょう。  

if文に使用している`contains`メソッドに関しては公式のドキュメントを確認してください。  
ここでのif文の意味はログインしていて、かつ、  
ログインユーザーのidがその日記をいいねしてるユーザーのidの中に含まれていれば。  
といった意味になります。

### 参考リンク
[contains | コレクション](https://readouble.com/laravel/5.7/ja/collections.html#method-contains)


## まとめ
これでいいね機能は完成です。  
今回はいいね機能でしたが、
ブックマーク機能はもちろん、投稿へのコメントや、  
タグのような機能も今回学んだ**多対多**のリレーションになるため、  
同じようなやり方で作成できます。  
