<h2 style="color: orange;">Relationships</h2>

Modelで１対ｎのrelationを扱いたいと思います。ユーザーが複数のツイートを持つ様に、UserModelとTweetModelを関連付けます<br>
<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>

- Relationshipsについて
- 1対1のRelationについて

<h2 style="color: orange;">Model</h2>
UserモデルとTweetモデルを１対ｎで関連付けます。<br>
<br>

```
// app/User.php

<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function tweets() 
    {
        return $this->hasMany('App\Tweet');
    }
}


```

<br>

`app/User.php`にtweets()メソッドを作成し、`hasMany()メソッド`で`AppTweet`と関連付けます。<br>
hasMany()メソッドは1対多の関係を定義するために使われています。詳細は<a href="https://readouble.com/laravel/5.1/ja/eloquent-relationships.html">こちら</a>のサイトに詳しく書いてありますので参考にしてください。<br>
これで以下のように Userに関連付く Tweetをn件取得できるようになります。<br>
<br>

```
// ユーザーIDが1のツイートを取得することができるようになった。
$tweets = User::find(1)->tweets();
```

<br>
この場合、Tweetモデルにも関連付けさなくてはいけません。<br>
<br>
user()メソッドを作成し、`belongsTo()メソッド`で **AppUser** と関連付けます。<br>
これで以下の様に Tweetに関連付く、Userを１件取得できるようになります。<br>

```
// TweetIDが1のツイートを投稿しているユーザーのデータを取得する

$user = Tweet::find(1)->user();
```

<br>

### Migration
TweetsテーブルにUsersテーブルへの外部キーを追加します。<br>以前に作成したマイグレーションファイルを直接修正し、DBは全てロールバックして、初めから再構築したいと思います。<br>
なので下記コマンドを入力してください。<br>

```
// データを全てリセット(テーブルを空にする)
php artisan migrate:refresh
```

<br>
そして、◯◯◯◯◯◯-create_tweets_table.phpに外部キーを追加します。<br>
<br>

```
// database/migrations/◯◯◯◯◯◯-create_tweets_table.php

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();   // 追加
            $table->string('title');
            $table->text('content');
            $table->timestamps();

            // 外部キーを追加
            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tweets');
    }
}
```

<br>
`user_id` を外部キーとして追加しました。<br>
外部キー制約に `onDelete(‘cascade’)` を指定し、親レコードであるUsersのデータが削除されたら、子レコードであるTweetsのデータも削除するように指定しました。(外部キーの有効化)<br>
それでは、再度全マイグレーションを実行します。<br>

<h2 style="color: orange;">Seed</h2>
Tweetsテーブルの変更に伴い、Seedも修正します。<br>
<br>

```
// database/seeds/DatabaseSeeder.php

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Curriculum;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UsersTableSeeder');  // 追加
        $this->call('CurriculumsTableSeeder');

        Model::reguard();
    }
}

// 追加
class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'root',
            'email' => 'root@sample.com',
            'password' => bcrypt('password')
        ]);
    }
}

class CurriculumsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('curriculums')->delete();

        $faker = Faker::create('en_US');

        for ($i = 0; $i < 10; $i++) {
            // Curriculum::create([
            //     'title' => $faker->sentence(),
            //     'content' => $faker->paragraph(),
            //     'open_flag' => 1,
            //     'permission_level_id' => 1,
            //     'category_id' => 1
            // ]);

            $tweet = new Tweet([
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
                'published_at' => Carbon::now(),
            ]);
            $user->tweets()->save($tweet);  // $userと関連付けて$tweetを保存
        }
    }
}
```

<br>
ユーザーデータを１件追加するようにし、ツイートデータをユーザーと関連付けて保存するよう変更しました。<br>

<h2 style="color: orange;">Controller</h2>
ツイートの新規登録時に、ユーザーと関連付ける様に修正します。<br>
<br>

```
// app/Http/Controllers/TweetsController.php
 
class TweetsController extends Controller {
    ...
    public function store(TweetRequest $request) {
        // Tweet::create($request->all());
        \Auth::user()->tweets()->create($request->all());
 
        \Session::flash('flash_message', 'ツイートを追加しました。');
 
        return redirect()->route('tweets.index');
    }
    ...
}
```

<br>
**store()メソッドで新規のツイートを、ログイン中のユーザーのツイートとして保存**します。<br>
ここまで書ければOkay！最後に動作確認をしっかりしておきましょう。<br>

<h2 style="color: orange;">まとめ</h2>

- $user->tweetsでユーザーモデルからTweetにアクセス出来ました。
- $tweet->userでTweetモデルからユーザーモデルにアクセス出来ました。
