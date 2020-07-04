<h2 style="color: orange;">【Laravelをインストールしてみよう！】</h2>

<img src="http://hackers.nexseed.net/images/curriculum_images/laravel_image.png" style="width: 100%"><br>

<h2 style="color: #00CCFF;">このカリキュラムで学ぶこと</h2>
- Laravelのインストール方法
- Composerについて
- Laravelの環境設定

### Composer経由でのLaravelをインストールしてみよう！

composer経由でLaravelをインストールします。が、その前にComposerについて少し触れてみましょう。

<h2 style="color: orange;">【Composerとは？】</h2>

> composerとはPHPのパッケージ管理システムである。<br>
composerを使えば、コマンド一発で必要なパッケージをすべてインストールできる。<br>
composerがない環境、つまりパッケージ管理システムがない環境では、メンバーがそれぞれ必要なライブラリの公式サイトにアクセスし、zipファイルをダウンロードし、ローカルに展開する。<br>
DB接続用に○○、ログ出力用に△△等々、さまざまなライブラリが必要になる。<br>
パッケージ管理システムはそれらを個人の裁量に依存せずに導入できる仕組みを提供する。<br>
つまりcomposerを使えば、コマンド一発で必要なパッケージをすべてインストールできる。


<h2 style="color: orange;">1.【Composerをインストールしてみよう！】</h2>
Laravel ではパッケージ（ライブラリ）の依存関係の管理に composer を使用しています。<br>
そのためLaravel を動かすコンピュータには composer をインストールする必要があります。<br>

#### ①Macの方はiterm(Terminalでも可)、Windowsの方はTera Termを開いてください。

#### ②ComposerのWebページからCUIを通してインストールする。

下記のUnixコマンドを上記で開いたアプリに貼り付けてください。<br>
<br>

```
sudo curl -sS https://getcomposer.org/installer | php
```

<br>

`permission deny`というエラーが発生したら、**sudo**を頭につけてコマンド実行してください<br>

#### ③LaravelのプロジェクトをXAMPP直下で動かすため、Composerを下記のパスへ移動させる。

**パス : /usr/local/bin/composer**

ターミナル上で下記のコマンドを実行。<br>
<br>

```
mv composer.phar /usr/local/bin/composer
```

#### ④インストール完了を確認する。
しっかりとインストールが完了されているかどうかを確認するため、composerのversionを確認する。<br>
<br>

```
composer -v
```

<br>
少し上にスクロールすると下の画面が確認できます。<br>
この画面が表示されれば無事にインストール完了です。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/composer.png" style="width: 100%"><br>

<h2 style="color: orange;">2.【Laravelをインストールしてみよう！】</h2>
Composerのインストールが終わったところで今度はLaravelのプロジェクトを作成しましょう。<br>
laravel でプロジェクトを作成する方法は２通りあります。<br>
* composer 経由でプロジェクトを作成
* laravel インストーラでプロジェクトを作成
<br><br>

今回はComposer経由でインストールします。

#### ①Laravelのプロジェクトを作成
composer コマンドに create-project オプションを指定してプロジェクトを作成します。<br>
<br>

```
composer create-project laravel/laravel --prefer-dist プロジェクトの名前
```

<br>

**‘laravel/laravel’** の部分は **‘ベンダー名/パッケージ名’** です。<br>
laravel のプロジェクトを作成するには **‘laravel/laravel’** と指定します。
<br><br>

‘–prefer-dist’ の部分はオプションになり、以下の２種類が指定できます。<br>
<br>
* –prefer-source: ソースコードリポジトリから開発版をダウンロードします。
* –prefer-dist: リリース版、安定版をダウンロードします。
<br><br>

また、composer経由の場合、**バージョン指定が可能**で、古いバージョンのLaravelでプロジェクトを作成することもできます。以下は **Version5.1** を指定した例です。

<br>

```
composer create-project laravel/laravel --prefer-dist プロジェクト名 5.1
```

<br>

NexSeedのカリキュラムでは、**Version5.1**を使用して進めていきますので、下記のコマンドを**htdocs直下に**打ち込んでください。<br>
<br>

```
composer create-project laravel/laravel --prefer-dist Learn_SNS 5.1
```

<br>
プロジェクト名は**「Learn_SNS」**、Versionは**5.1**です。


#### ②プロジェクトが作れているか確認する。

htdocsの直下に**「Learn_SNS」**ができていれば完了です。<br>

<h2 style="color: orange;">3.【プロジェクト内環境設定】</h2>
プロジェクトのディレクトリに移動して、環境設定を行います。<br>
<br>

```
cd Learn_SNS
```

### .env

#### .envファイルとは
> .env ファイルは実行環境ごとに分ける必要がある情報を格納しています。<br>
パスワードやデーターベース名等を開発機やステージング機、商用機等毎に個別に設定することが出来ます。

<br>
.envファイルが作成されていない場合は、.env.exampleからコピーして作成後、key:generateを実行します。<br>
コピーコマンドの使い方は<br>
<br>

```
cp コピーするファイルの名前 コピー元のファイル名
```

<br>
従って以下のようになります。<br>
<br>

```
cp .env.example .env
```

<br>
そして、key:generateを実行します。<br>
<br>

```
php artisan key:generate
```

<br>
*php artisan key:generate* を実行すると .env 内の APP_KEY に**アプリケーション固有のランダムストリングが設定されます。**<br>
**APP_KEYはユーザーのセッション情報やパスワードの暗号化等をセキュアにする為に必要になります。**<br>

### config/app.php
app.phpに書かれている**時間を日本時間に、言語を日本語**に変えましょう。
<br>

```
// config/app.php
return [
    // ...

    'timezone' => 'Asia/Tokyo',
    'locale' => 'ja',

    // ...
];
```

### config/database.php
このページではデータベースの設定をします。<br>Laravelでは、デフォルトで設定されていますが、念のため設定例を載せておきます。<br>
下記の例はDBを mysqlに設定した時の例です。<br>
<br>

```
// .env
...

DB_CONNECTION=mysql

...

```

<br>
<br>

```
// config/database.php

return [
    ...

    'default' => env('DB_CONNECTION', 'mysql'),

    ...

    'connections' => [
        'mysql' => [
            'driver'   => 'mysql',
            'database' => storage_path().'/database.mysql',
            'prefix'   => '',
        ],
        ...
    ],
    ...
];

```

### ビルトインサーバー立ち上げ
LaravelをComposer経由でインストールし、環境設定をしました。<br>
次はCUI操作で下記のコマンドを入力します。<br>
<br>

```
Mac↓

php artisan serve

Windows↓

php -S localhost:8000 -t public

```

<br>
wwwブラウザで<a href="http://localhost:8000">localhost:8000 </a>にアクセスし、**Laravel 5** と大きなロゴが表示されれば成功です。<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/open_laravel.png" style="width: 100%"><br>
<br>

<h2 style="color: #33CC00;">やってみよう！</h2>

Laravelに限らず、そのほかのフレームワークでも同様ですが、パーミッションを正しく指定しているはずなのに、ファイルキャッシュが書き込めないという状況になることがあります。<br>
これは、`Webサーバーの動作ユーザー／グループ`と`Laravelをインストールしたユーザー／グループ`が異なることが原因です。<br>
この問題はLaravelやPHPに限らず、Webサーバーの動作により作成するファイルに、ユーザーがコマンドでアクセスする場合、**その逆にユーザーにより作成されたファイルに、Webサーバーから起動されたプログラムやスクリプトからアクセスする場合に起きるもの**です。<br>そのため、根本的な解決には、サーバー設定とパーミッションの知識が必要となります。<br>
パーミッションで下記のディレクトリの書き込み権限、読み込み権限を解放する必要があります。<br>
<br>
権限を解放する必要があるディレクトリは**storage**と**bootstrap/cache**ディレクトリです。<br>
本来はwwwサーバの設定に合わせて**chown**や**chmod**を設定しますが、今回は下のように設定しましょう。<br>
itermを開き下記のコマンドを入力してください。<br>
<br>

```
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

<br>
これでパーミッションの開放は完了しました。
