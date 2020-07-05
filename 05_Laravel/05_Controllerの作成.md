<h2 style="color: orange;">Controllerの作成</h2>
前のカリキュラムではViewを作成しました。今回はControllerを作成したいと思います。

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- PagesControllerの作成(CUI操作)
- plain以外のControllerの作り方

<h2 style="color: orange;">Controllerの作成</h2>
まず始めにRoutingの設定をします。<br>
<br>

```
// routes/web.php

Route::get('/', 'WelcomeController@index');
Route::get('contact', 'WelcomeController@contact');
Route::get('about', 'PagesController@about');    // 追加
```

<br>

新規にControllerを作成する時はartisanコマンドを使用します。<br>
普段通り、一からファイルを作ってクラスを作って...と書いていけるのですが、初めから作ると時間がかかります。<br>
しかし、元々Laravelのプロジェクトに入っている**artisanコマンド**を使用すれば一から作らなくてもコマンドを入力するだけで作れてしまいます。<br>
実際にコマンドを入力してPagesControllerを作ってみましょう。<br>
<br>

```
php artisan make:controller PagesController　--resource
```

<br>

前回のページの表示フロー</a>のカリキュラム内で<br>
Controllerを作成した時と同様のコマンドです<br>
今回はオプションで追加があります。
どうなっているかControllerを確認してみましょう。<br>
<br>

```
// app/Http/Controllers/PagesController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
```

<br>

プレーンの時は中身が空でしたが、今回は色んなメソッドが自動で作成されています。<br>
なんと -- resource なしでartisanコマンドを入力すると**CRUD処理のメソッドを含めた状態のControllerが自動で生成される**のです。<br>
中にデフォルトでメソッドが入っていないControllerが欲しい場合は --resource をコントローラー名の前に半角スペース空けてつけてあげましょう。<br>
次はController内にあるメソッドの役割について説明します。<br>

<h2 style="color: orange;">Controller内のメソッドについて</h2>
PagesControllerの中にあるメソッドの役割は下記のようになっています。<br>

- C
	- **create** 作成画面(表示)
	- **store** (作成)処理
- R
	- **index** 一覧表示
	- **show** 一件詳細表示
- U
	- **edit** 編集画面表示
	- **update** 更新処理
- D
	- **destory** 削除処理

<br>
LaravelのController内メソッドは一つ一つに意味があり、デフォルトで割り振られています。<br>
このメソッドの使い方などの説明は違うカリキュラムで行います。<br>
今回はPagesController内のメソッドは不要な為、全て削除しておきましょう。<br>


<h2 style="color: orange;">View関数について</h2>
では、PagesControllerにaboutメソッドを追加し、viewの表示を行います。<br>
resouces/viewsディレクトリの下に pagesディレクトリを作り、そこに about.blade.phpを作成しましょう。<br>
<br>

```
// resouces/views/about.blade.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function about() {
        return view('pages.about');
    }
}
```

<br>

**view関数の引数に注目**してください。ピリオドで区切って ‘pages.about’ としています。<br>
resources/viewsディレクトリにサブディレクトリがある場合、**‘サブディレクトリ名.ビュー名’** と指定します。<br>

Controllerの設定は完了しました。次はViewを作成しましょう。<br>

```
// resources/views/pages/about.blade.php

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>About</title>
</head>
<body>
	<h1>About this page</h1>
</body>
</html>
```

<br>
pagesディレクトリを作成し、about.blade.phpを作成しました。<br>

### 動作確認
ブラウザで http://localhost:8000/about へアクセスしてみましょう。<br>

まずは、ブラウザに表示させるためには、Laravel内のビルドインサーバーを下記コマンドで立ち上げる必要がありますね。<br>

```
Mac↓

php artisan serve

Windows↓

php -S localhost:8000 -t public
```

<br>
上記コマンドを入力後、ページに “About this page” が表示されれば成功です。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/create_controller.png" style="width: 100%"><br>
<br>
新しく作成したPagesController経由でViewを表示することができました。

<h2 style="color: orange;">まとめ</h2>

- Controller作成のパターン
	- --plain付きかなしか
- Controller内のデフォルトメソッド
	- CRUD処理
- View関数の使い方
	- View('views直下のディレクトリ名.View名');
