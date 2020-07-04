# 認証機能(事前準備)

## 学ぶこと
このカリキュラムでは認証機能(サインアップ、ログイン)作成の準備を通して以下のことを学びます。  
1. 既存のテーブルへのカラムの追加
2. テーブルのリレーション
3. テストデータの作成

以下の順番で学びます。  
1. diariesテーブルにuser_idカラムを追加
2. UserとDiaryのリレーションの定義
3. usersテーブルにテストデータを作成する準備
4. diaryesテーブルにテストデータを作成する準備
5. テストデータの作成


## diariesテーブルにuser_idカラムを追加
カラムを追加する場合の手順も基本的にテーブルの作成と同じです。
1. マイグレーションファイルの作成
2. マイグレーションファイルの編集
3. マイグレーションの実行

どのユーザーが日記を投稿したかわかるようにします。

### マイグレーションファイルの作成
以下のコマンドを実行してください。
```php
// user_idをdiariesテーブルに追加するためのマイグレーションファイルを作成
php artisan make:migration add_user_id_to_diaries --table=diaries
```

`database`ディレクトリに`yyyy_mm_dd_hhmmii_add_user_id_to_diaries.php`というファイルが作成されます。  

今回は、diariesテーブルにidを追加するファイルのため、  
`add_user_id_to_diaries`という名前にしてます。 

### マイグレーションファイルの編集
`up` メソッドを以下の通り編集します。  

```php
// yyyy_mm_dd_hhiiss_add_user_id_to_diaries

 public function up()
 {
     Schema::table('diaries', function (Blueprint $table) {
         $table->integer('user_id')->unsigned();

         //外部キーに設定
         $table->foreign('user_id')->references('id')->on('users');
     });
 }

```

### マイグレーションの実行
```php
php artisan migrate:fresh
```

マイグレーションの際に`php artisan migrate`ではなく、`php artisan migrate:fresh`理由を説明します。    
新たにカラムを追加する場合、すでに保存されているデータの、追加したカラムの値は`NULL`になります。  
しかし、`user_id`には投稿したユーザーのidを入れるため、NULLを許可しないように設定します。  
そのため、普通に`php artisan migrate`をしてしまうと、  
`user_id`カラムには`NULL`が許可されていないということでエラーになります。  

`php artisan migrate:fresh` は一旦全てのテーブルを削除して新たに作成します。    


## UserとDiaryのリレーションの定義
Userは複数のDiaryを持つため、テーブルの関係性は、**1対多** となります。  
Laravelではテーブルのリレーション(関係性)も簡単に表すことができます。  

1対多のリレーションを表す場合は以下のようになります。  
```php
// app/User

public function diaries()
{
    return $this->hasMany('App\Diary');
}
```

### 参考リンク
[1対多のリレーション](https://readouble.com/laravel/5.7/ja/eloquent-relationships.html#one-to-many)


1. usersテーブルにテストデータを作成する準備
## usersテーブルにデータを挿入するSeederの作成

以下のコマンドでテストデータ作成用のファイルを作成します。  
`php artisan make:seeder UsersTableSeeder`

作成したファイルの内容を以下のように変更してください。  

```php
// database/seeds/UsersTableSeeder.php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'pikopoko',
            'email' => 'pikopoko@gmail.com',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
```

## diaryesテーブルにテストデータを作成する準備

diariesテーブルにカラムを追加したため、  
投入するテストデータも変更します。  

```php
// database/seeds/DiariesTableSeeder.php

public function run()
{
    $user = DB::table('users')->first(); //追加

    $diaries = [
        [
            'title' => 'セブでプログラミング',
            'body'  => '気づけばもうすぐ2ヶ月',
        ],
        [
            'title' => '週末は旅行',
            'body'  => 'オスロブに行ってジンベエザメと泳ぎました',
        ],
        [
            'title' => '英語授業',
            'body'  => '楽しい',
        ],
    ];

    foreach ($diaries as $diary) {

        DB::table('diaries')->insert([
            'title' => $diary['title'],
            'body' => $diary['body'],
            'user_id' => $user->id, //追加
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
```

## テストデータの作成

今回作成した2つのテストデータを同時に作成するため、  
`DatabaseSeeder.php`の`run`メソッドを以下のように編集します。  
```php
// database/seeds/DatabaseSeeder.php

public function run()
{
    $this->call(UsersTableSeeder::class);
    $this->call(DiariesTableSeeder::class);
}
```

最後に以下のコマンドを実行してDBにデータが作成されていることを確認します。  
`php artisan db:seed`
