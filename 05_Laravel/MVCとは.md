<h2 style="color: orange;">【MVCモデルとは】</h2>
オブジェクト指向について理解ができたら、次はMVCモデルについて学習していきます。

MVCモデルとは、ソフトウェア設計モデルの一つです。<br>現在主流のフレームワークはこのMVCモデルを採用しているものが多く、MVCの概念を理解すれば新しいフレームワークを使う際も理解が早くなりますので、しっかり理解していきましょう。<br><br>

MVCは、プログラムを<br><span style="color: red;">Model（モデル）、View（ビュー）、Controller（コントローラ）</span><br>という3つの要素に分割し、互いに呼び出し合って実行されるモデルのことを指します。<br>
MVCはそれぞれ次のような特徴を持ちます。

### Model
**データの処理** を担当。要求された処理を行い、結果を返す。（データベース操作、入力チェックなど）

### View
**表示、出力** を担当。主にユーザへ表示するHTML/CSSを作成する。

### Controller
ViewとModelの **制御** を担当。ユーザからのリクエストに対し、Modelへ処理を依頼したり、Viewへ表示する内容を依頼したりする。

MVCの関係性は、次の図のようになります。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_1.png" style="width: 60%;">

特徴としては、ビュー・モデル・コントローラそれぞれが独立していることです。  
独立しているため、ビューはコントローラの処理に依存しないし、コントローラもモデルの処理に依存しません。  
MVCモデルで設計しておくと、 **互いの仕様変更の影響を受けにくい** というメリットがあります。  
例えば、「画面のデザインを変更したい」という場合はViewのファイルだけ修正すればいいですし、「入力チェックの処理をもっと細かくしたい」という場合はModelのファイルだけ修正すればよいことになります。

# MVCモデルの流れ
MVCモデルで設計されたWebアプリケーションの流れを見てみましょう。

今までは、Webアプリケーションを使用する時はブラウザから
```
http://www.xxx/yyy/zzz.php
```
というようにPHPファイルにアクセスして処理を実行していました。
MVCモデルの場合、URLで直にControllerのphpファイルにアクセスすることはしません。ブラウザからリクエストURLを受け取ってどのControllerを呼び出すか判定する **Routeファイル** を作成し、どんなURLでアクセスされてもまずはそのRouteファイルを介すようにします。

ユーザがブラウザからリクエストURLを送ると、サーバがリクエスト情報を受け取り、該当のRouteファイルにそのリクエスト情報を渡します。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_2.png" style="width: 60%;">

Routeファイルがリクエストを受け取り、URLによってどのControllerを呼び出すか判定して該当のControllerを呼び出します。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_3.png" style="width: 60%;">

呼びだされたControllerが、Modelを呼び出して処理を依頼します。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_4.png" style="width: 60%;">

呼びだされたModelが、DBアクセスや入力チェックの処理を行い、結果をControllerに返します。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_5.png" style="width: 60%;">

結果を受け取ったControllerは、表示するViewを判定し、ブラウザへレスポンスを返します。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_6.png" style="width: 60%;">

これが一連の流れになります。

# MVCモデルのフォルダ構造
実際にMVCモデルでWebアプリケーションを作成するときのフォルダの構成を見ていきましょう。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_folder.png" style="width: 60%;">

Webアプリケーションのディレクトリの直下に、「controllers」「models」「views」ディレクトリがあります。この各ディレクトリの中に、Controller、Model、ViewのPHPファイルを作成します。

「.htaccess」ファイルは、Apacheサーバ用の設定ファイルで、管理者権限がなくてもアプリケーションディレクトリ単位で作成・設定ができます。

「routes.php」というPHPファイルが、前述したRouteファイルになります。

# MVCの命名規則
PHPのMVC設計では、ディレクトリ名やファイル名、URL、アクションに基づいた関数の名前など、あらかじめ決められた **命名規則** （ルール）が存在します。  
その命名規則に従うことで、拡張性や保守性が高まり、チーム開発がしやすくなります。

PHPのMVC設計の場合、URLの形式は基本的に次のようになります。

```
http://ドメイン名/アプリケーション名/リソース名/アクション名/オプション
```

|名称|説明|
|:--|:--|
|ドメイン名|インターネット上のネットワークを特定するための名前<br>例：`http://www.xxxxx.net`というURLのうち`www.xxxxxx.net`の部分|
|アプリケーション名|アプリケーションフォルダの名前|
|リソース名|WEBサービスが保持するデータを大きく種別にしたもの<br>基本的には **テーブル名と同じ（複数形）** |
|アクション名|CRUDを分解し、フレームワークの規則に従い付けられた名前|
|オプション|コンテンツをわけるための単位（ID、年月日、ページ数など）|

**リソース名** は、基本的にテーブル名と同じく複数形で表現します。  
例えばseed_SNSのシステムで、「tweets」という名前のテーブルから情報を取得し表示しているページの場合、次のようになります。

```
http://localhost/seed_sns/tweets/...
```

**アクション名** は、CRUDに基いて分解された処理の名前で表現します。原則として7種類あります。

* index
  * データの一覧ページを表示する
* show
  * データ（1件）の詳細ページを表示する
* edit
  * データの編集ページを表示する
* update
  * データの更新処理をする
* add
  * データの新規作成ページを表示する
* create
  * データの新規登録処理をする
* delete
  * データの削除処理をする

例えばseed_SNSのシステムで、データの詳細を表示しているページ（view.php）の場合、次のようになります。

```
http://localhost/seed_sns/tweets/show/
```

**オプション** は、コンテンツを更に詳細に分けるための単位として使用します。IDや年月日、ページ数などが入ります。  
「show」「edit」アクションでよく使用されます。  
例えばseed_SNSのシステムで、tweet_id=5のデータの詳細ページを表示する場合、次のようになります。

```
http://localhost/seed_sns/tweets/show/5
```

# Controller
リソース名とアクション名は、URLだけでなくディレクトリ名やPHPファイル名にも適用されます。  
「controllers」ディレクトリ内につくるPHPファイルは、「リソース名の複数形_controller.php」という名前になります。

例えばseed_SNSのシステムでControllerを作成する場合、ファイル名は次のようになります。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_controller.png" style="width: 60%;">

また、Controller内部に **アクション名と同一の関数** を作成します。  
そうすることで、ControllerがRouteファイルから呼び出された際、どのような処理を行えばいいのかがわかりやすくなります。

Controllerは、Controllerクラスとして作成します。  
クラス名は **「リソース名の複数形＋Controller」** という命名規則になります。  
クラス内にアクション名と同一のメソッドを作成します。イメージとしては次のとおりです。

```php
<?php
    /**
    * Controllerのクラス
    */
    class TweetsController {
        // プロパティ
        private $hoge = '';
        private $fuga = '';

        // コンストラクタ
        public function __construct () {
          // 初期化処理
        }

        /** 一覧ページを表示 */
        public function index() {
          // 処理
        }

        /** 詳細ページを表示 */
        public function show($id) {
          // 処理
        }

        /** 編集ページを表示 */
        public function edit($id) {
          // 処理
        }

        /** 削除 */
        public function delete($id) {
          // 処理
        }
    }
?>
```

# Model
「models」ディレクトリ内につくるPHPファイルは、「リソース名.php」という名前になります。

例えばseed_SNSのシステムでModelを作成する場合、ファイル名は次のようになります。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_model.png" style="width: 60%;">

ModelはControllerから呼び出され、データの処理を行うので、受け取った値をチェックしたり、DBにアクセスしてSQLを実行し結果を返却するといった処理がメインになります。

ModelもControllerと同じくModelクラスとして作成します。  
クラス名は、ファイル名と同じリソース名ですが、クラス名なので先頭が大文字になります。イメージとしては次のとおりです。

```php
<?php
    class Tweet {
        // プロパティ
        private $hoge = '';
        private $fuga = '';

        // コンストラクタ
        public function __construct () {
          // 初期化処理
        }

        /** Controllerのアクションメソッドから呼び出される */
        public function view($value) {
            // DBアクセス処理
        }

        /** Controllerのアクションメソッドから呼び出される */
        public function update($value) {
            // DBアクセス処理
        }

        /** Controllerのアクションメソッドから呼び出される */
        public function delete($value) {
            // DBアクセス処理
        }
    }
?>
```

# View
「views」ディレクトリ内には、まず **リソース名の複数形** の名前のディレクトリを作成し、その中に「アクション名.php」ファイルを作成します。

例えばseed_SNSのシステムでViewを作成する場合、ファイル名は次のようになります。

<img src="http://hackers.nexseed.net/images/curriculum_images/mvc_view.png" style="width: 60%;">

ViewはControllerから呼びだされ、画面に表示する内容を出力する処理を行います。そのため、Viewはクラスを持たず、HTMLコードがメインのファイルになります。

# ルーティング
MVC設計について見てきましたが、「この流れだと直接Controllerを呼び出した方が早いのでは？」と思う方もいるかもしれません。  
ですが、Controllerはクラスでできているため、実体がないので処理を実行することができません。Controllerをインスタンス化して呼び出す処理を、Routeファイルで行うのです。

しかしながら、このままでは命名規則に従った「http://localhost/seed_sns/tweets/show/」というようなURLにアクセスしても、Routeファイルを呼び出すことができません。  
上記のようなURLが送られてきた時、URLを判定し適切なControllerを呼び出す処理をするRouteファイルを一番最初に実行する必要があります。

リクエストURLを判定し、適切な処理を呼び出すことを「**ルーティング** 」といいます。  
ルーティングの設定は、「.htaccess」ファイルと「routes.php」を使います。

ルーティングの細かい設定方法については、この後フレームワークを作成しながら見ていきましょう。
