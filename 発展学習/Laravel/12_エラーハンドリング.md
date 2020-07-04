# エラーハンドリング

## 学ぶこと
このカリキュラムではエラーハンドリングに関して学びます。  
エラーハンドリングとは、  
エラーが発生した時にどのように対処するかあらかじめ決めておくことです。  
エラーとは、(ここでは)本来想定してることと、ユーザーが異なる操作をすることです。  
例えば存在しないページを表示しようとすることなどです。  

今回は
1. 存在しないページにアクセスされた場合
2. 存在するが、ユーザーに表示する権限がないページにアクセスされた場合
の2つに関して説明します。  


## 存在しないページにアクセスされた場合
存在しないページにアクセスされた場合、  
ユーザーに存在しないページにアクセスしたことを伝えるため、  
404ページを表示します。  

Laravelではルートの定義を少し変更するだけでこの機能を実装できます。  

1. web.phpのルート定義で、`{id}`となってる部分を`{diary}`に変更します。  
2. 1で変更したルートと対応するコントローラーのメソッドの仮引数を`int $id`から`Diary $diary`に変更します。  
3. 2で仮引数を変更したメソッドから`$diary = Diary::find($id)`を削除します。  

まず上記の1, 2について説明します。  
Laravelの機能として、  
web.phpのルートの定義で、`{diary}`の部分と、対応するControllerのメソッドの仮引数名`($diary)`が同じで、
引数が型指定`Diary`となっていた場合、**自動的に該当するモデルのインスタンスを作成します。**
インスタンスを作成できない場合(該当のidがない場合)は404を返してくれます。  

また、モデルのインスタンスが1, 2の処理で作成されるため、  
各メソッドに書いていた、`$diary = Diary::find($id)`が不要になります。


例えば、Editメソッドの場合は以下のようにかわります。 
URLに入るidを存在しないIDにした場合、404のエラーが表示されます。   

```php
// routes//web.php

Route::get('diary/{diary}/edit', 'DiaryController@edit')->name('diary.edit')

```

```php
// app/Http/Controllers/DiaryController

public function edit(Diary $diary)
{
  return view('diaries.edit', [
      'diary' => $diary,
  ]);
}

```


## 存在するが、ユーザーに表示する権限がないページにアクセスされた場合

### 編集、削除ボタンを非表示にする

日記の一覧ページでは、
自分の投稿だけではなく、他のユーザーの投稿も編集、削除ができるようになっているため、  
これを改善します。  

まずは自分の投稿以外では編集、削除ボタンが表示されないように変更します。  

```php
// resources/views/diaries/index.blade.php


@if (Auth::check() && Auth::user()->id === $diary->user_id)  // 追加
    <a class="btn btn-success" href="{{ route('diary.edit', ['id' => $diary->id]) }}">編集</a>
    <form action="{{ route('diary.destroy', ['id' => $diary->id]) }}" method="post" class="d-inline">
        @csrf
        @method('delete')
        <button class="btn btn-danger">削除</button>
    </form>
@endif  // 追加

```
`Auth::check()`はログインしているかをチェックします。 ログインしてる場合は`true`を返します。  
`Auth::user()->id`はログインしているユーザーのidを返します。  

if文の条件は、①ログインしていて、かつ②ログインユーザーのIDと日記のIDが同じ場合のみ、ということになります。  

②の条件だけで十分ではないかと思う方がいるかもしれませんが、  
`Auth::user()->id === $diary->user_id`だけではなく、  
`Auth::check() && Auth::user()->id === $diary->user_id`しているのは、  
ログインしていない場合、`Auth::user()->id`が使用できないからこの条件になっています。  

これで編集、削除ボタンは表示されなくなりましたが、URLを直接入力すると表示されてしまいます。  
確認してみましょう。次はこれを改善します。  

## URLを直接入力しても表示できないようにする

以下の内容を`edit`, `update`, `destroy`メソッドの一番上に追記してください。  

```php

//app/Http/Controllers/DiaryController

if (Auth::user()->id !== $diary->user_id) {
    abort(403);
} 

```

## 参考リンク
[エラー処理](https://readouble.com/laravel/5.7/ja/errors.html)

## おまけ

### エラー画面の作成
1. `resources/views/errors/`ディレクトリを作成
2. 1で作成したディレクトリにステータスコード.blade.phpを作成(例:404.blade.php)
上記のように作成することで、エラーが発生した場合、対応するステータスコードの画面が表示されます。  
