<h2 style="color: orange;">DBへのSeeding</h2>

Laravelでは 初期データをDB(データベース)に埋め込むことができるコマンドが存在します。<br>
`artisan db:seed` コマンドを使って、システムに必要な初期データを作成したり、開発で使用するサンプルデータを作成することができます。<br>今回はTweetsテーブルに開発で使用するサンプルデータを作成してみます。<br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Seedingについて
- Seedingの方法

<h2 style="color: orange;">DatabaseSeederファイルを編集しよう</h2>
DBに初期データを埋め込むには以下のファイルを編集する必要があります。<br>
<br>

```
// database/seeds/DatabaseSeeder.php

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();  // ①

        	// $this->call('UserTableSeeder');

        Model::reguard();  // ②
    }
}
```

<br>
① **unguard()メソッド**は、<span style="color: red;">EloquentのマスアサインメントをOFFにします。</span><br>
② **reguard()メソッド**は、<span style="color: red;">EloquentのマスアサインメントをONにします。</span><br>
これから**DatabaseSeeder.phpファイル**を実際に触れていきたいと思います。<br><br>

```
// database/seeds/DatabaseSeeder.php

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Tweet;

class DatabaseSeeder extends Seeder
{

    public function run()  // ①
    {
        Model::unguard();

        $this->call('TweetsTableSeeder');  // ②

        Model::reguard();
    }
}

class TweetsTableSeeder extends Seeder  // ③
{
    public function run()
    {
        DB::table('tweets')->delete();  // ④

        $faker = Faker::create('en_US');  // ⑤

        for ($i = 0; $i < 10; $i++) {  // ⑥
            Tweet::create([
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
                'published_at' => Carbon::today()
            ]);
        }
    }

}
```

<br>

### ポイント解説
1. php artisan db:seed コマンドを実行すると、DatabaseSeederクラスの **run()メソッド** が実行されます。
2. **run()メソッド**の中から、TweetsTableSeederをコールします。
3. テーブル毎にSeederの派生クラスを作成すると、管理しやすくなります。
4. Query Builderを使用して、Tweetsテーブルのレコード(データ)を全て削除しています。
5. Fakerを使用してダミーデータを作成しています。Laravel 5.1では標準でFakerが使用できるようになっています。
6. for文で10件のデータを作成します。

<h2 style="color: orange;">Seeding実行</h2>
**php artisan db:seed** コマンドを実行してみましょう。<br>
<br>

```
php artisan db:seed
Seeded: TweetsTableSeeder
```

<br>
サンプルデータがDBに保存されているか確認しましょう。<br>
**phpMyAdmin**を確認します。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/laravel_seeding_data.png" style="width: 100%"><br>
<br>
このようにtweetsテーブルにサンプルデータが10件追加されていれば成功です。<br>


<h2 style="color: orange;">まとめ</h2>

- php artisan db:seedコマンドでサンプルデータをDBへ登録できる
- Fakerというクラスを使用してサンプルデータを作成している
- マスアサインメントの ON / OFF
