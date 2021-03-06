<h2 style="color: orange;">phpMyAdminとは</h2>
ここではデータベース用操作ツールのひとつ、phpMyAdminについて見ていきます。<br>
<br>
データベースとは、WEBサービスに必要なデータを**テーブル**という２次元の表で管理します。<br>
本来、データベースを操作するには**CUI**（黒い画面にコマンドを打ち込み操作する画面）ベースのターミナルなどを使用するのですが、慣れないうちからこちらを使って学習しても本質的なデータベース操作法にフォーカスしづらいといったデメリットがありました。<br>
<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/about_phpmyadmin1.png" style="width: 80%"><br>
<br>
↑CUI（ターミナル）の画面例<br>
<br>
また、実際の開発現場でもCUIでは直感的にデータの管理がしづらく、**GUI**（ボタンや表などをグラフィカルに表示し操作する画面）ベースのツールがいくつか開発されるようになりました。<br>
その中のひとつが<span style="color: red;">**phpMyAdmin**</span>というGUIベースのデータベース操作ツール。<br>
<br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/about_phpmyadmin2.png" style="width: 80%"><br>
<br>
↑GUI（phpMyAdmin）の画面例<br>
<br>
上記CUIの画面とこちらのGUIの画面、データベースの操作においてできることは一緒。<br>
phpMyAdminを使用した場合はこの画面の使い方さえ覚えてしまえばデータベースの操作法学習に集中することができ、効率的な学習へと繋がります。<br>
<br>
<h2 style="color: orange;">画面・各種タブ解説</h2>

### データベース作成画面
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/about_phpmyadmin3.png" style="width: 80%"><br>
<br>
**まずはデータベースの作成から。**<br>
ブラウザで **http://localhost/phpmyadmin** と入力すると上記画面が表示されます。<br>
#### ①データベース新規作成
このNewを押すことで上記画面が開きます。<br>
#### ②データベース名入力
新規作成するためのデータベース名を入力します。<br>
#### ③照合順序設定
日本語のデータを保存する場合は必ず **uft8_general_ci** を指定します。<br>
こちらの指定をしないと、日本語のデータを登録した際に文字化けしてしまいます。<br>
ここでは"test_DB"という名前でデータベースを作成しますが、開発するシステムに合わせてデータベース名を決定してください。<br>

### テーブル作成画面
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/about_phpmyadmin4.png" style="width: 80%"><br>
<br>

#### ①データベース名
作成したデータベース名がリストアップされます。<br>

#### ②テーブル作成（テーブル名 / カラム数）
テーブル名を入力し、必要カラム数を設定します。ここではtest_tablesという名前でテーブルを作成しますが、開発するシステムに合わせてテーブル名を決定してください。<br>

### カラム設定画面
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/about_phpmyadmin5.png" style="width: 80%"><br>
<br>

#### ①カラム名
各種カラム名を入力します。

#### ②データ型
PHPにもありましたが、データが数字なのか文字なのか等、型を決めるために必要です。
VARCHAR型
PHPで説明したstring型にあたります。
TEXT型
改行を含む長文などの文字列はTEXT型を指定します。（ブログの記事、お問い合わせ内容 etc）

#### ③長さ/値
データの上限を指定します。VARCHAR型を選択した場合この値が必至になり、特に理由がない場合は255を指定しておく習慣になっています。（詳細を書くと大変長くなるので割愛）

#### ④A_I
**Auto Incriment**の略。データが作成される際、1から始まり自動的に1ずつ繰り上がっていく設定。基本、データのidなど一意に表現するためのカラムにPRIMARY KEYと合わせて設定します。

#### ⑤インデックス
データ検索の処理を効率化するための仕組みです。今回の学習ではPRIMARY KEYを指定しています。<br>
<br>
PRIMARY KEY（主キー）
絶対に他のレコードと重複しない一意（ユニーク）なデータにしたい場合に設定します。<br>
主キー制約が設定されたカラムにはPRIMARYというKey,Nameのユニークインデックスが作成され、そのカラムの値は他のカラムとの重複不可、かつnull（何も入れないという意味）も不可となります。
<br>
MySQL - <a href="http://shindolog.hatenablog.com/entry/2015/04/08/155457">インデックスとは</a><br>
MySQL - <a href="http://mysql.akarukutanoshiku.com/category6/entry30.html">PRIMARY KEY（主キー）とは</a><br>
<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/about_phpmyadmin6.png" style="width: 80%"><br>
<br>
↑テーブル作成後、④挿入タブからデータを一件作成した状態で①表示タグを開いている状態<br>

#### ①表示タブ
選択テーブルに登録されたすべてのデータを表示するためのタブ。
#### ②構造タブ
選択テーブルの構造（カラム名や型、インデックスの設定状況等）を確認するためのタブ。
#### ③SQLタブ
SQL文をそのまま入力・実行できる環境を提供するタブ。初期のSQL文学習はこのタブを使って行います。
#### ④挿入タブ
選択テーブルにデータを登録するためのタブ。各カラムに適当な値を入力し実行することでSQL文のINSERT文が実行される。
#### ⑤エクスポートタブ
選択テーブルの構造自体や登録されているデータの情報を.sqlファイル形式や.csv形式で書き出すことができるタブ。データのバックアップを取っておくときやチームメンバーにテーブル構造・ダミーデータなどを共有する際に使用します。
#### ⑥インポートタブ
.sqlファイルや.csvファイルのデータを読み込むことができるタブ。
#### ⑦操作タブ
テーブルの初期化や削除などができるタブ。

<h2 style="color: orange;">SQLタブを使ったSQL文学習法</h2>
SQL文の学習方法には大きく分けて３つ方法があります。<br>
1. CUI（ターミナル等）を使用してコマンドベースでの学習
2. phpと組み合わせての学習
3. phpMyAdminのSQLタブを使ったSQL文にフォーカスした学習

<br>
インターネットでSQL文について調べると1と2の学習法が多く表示されますが、こちらはSQL文以外にもターミナルやphpとの連携など、理解し全体像を掴まなければいけない範囲が多くなるためSQL文自体にフォーカスしづらくなってしまいます。<br>
<br>
phpMyAdminのSQLタブ内ではCRUD処理に対応するSQL文を直接入力・実行し結果を確認することができるため、特に初学者のSQL文学習におすすめです。<br>
これ以降の学習でも実際にこのタブを使いながら学習を進めていきます。<br>
