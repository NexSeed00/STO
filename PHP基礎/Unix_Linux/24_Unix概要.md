# UNIXとは

WindowsやmacOSと同じく、OSの一種です。

WindowsやMacは **GUI** （Graphical User Interface）と呼ばれるシステムで構成されており、「マウスを使ってアイコンをクリックしアプリを起動」というような直感的な操作が可能となっています。

それに対しUNIXは **CUI** （Character User Interface）と呼ばれるシステムで構成されており、マウス操作ではなく **コマンド** によってアプリを起動したり端末を操作するOSになります。

ちなみに、macOSはUNIXから派生したOSのため、iTermやターミナルを使ってUNIXと同じコマンドで操作ができます。

### GUIが生まれた背景
マイクロソフトのWindowsが普及するまで、世界のパソコンはほとんど専門的な知識のある技術者がCUIで操作していました。

これを専門的な知識のないユーザでも操作できるよう考えだされたのがGUIで、GUIを採用したWindowsの普及によって爆発的にパソコンのユーザー数は増えていきました。

### なぜCUIを勉強するのか
ネットやメールを使ったり、事務的な作業をするユーザの場合はGUIで十分なのですが、エンジニアはサーバを操作することが多々あります。  
サーバは「ユーザーのリクエストに早くレスポンスを返す」ということが何よりも優先順位の高いタスクになります。  
GUIは便利ですが、わかりやすい画面を作り出すためにメモリを沢山消費してしまい、高速処理の邪魔をしてしまうため、サーバーには不要のものとして認識されています。

サーバのOSにはほとんどGUIが搭載されていないため、Webアプリケーションエンジニアとして仕事をするにはCUIでの操作を習得する必要があります。

この章では基礎的なUNIXとコマンドを紹介していきますので、しっかり覚えて使えるようにしていきましょう。

# CUI実践
以下のサイトにアクセスし、Web上でUNIXコマンドを練習していきます。

<a href="http://www.masswerk.at/jsuix/" target="_blank">jsuix</a>

画面を開いたら、「> open terminal」をクリックし、ログインユーザ「guest」と入力してログインしてください。

### 基本的なコマンド
基本的なコマンドを紹介します。この表にある5つはすべて覚えておきましょう。

|コマンド|略|内容|
|:--|:--|:--|
|pwd|print working directory|自分が今どのディレクトリにいるのか調べる|
|mkdir|make directory|新しい空のディレクトリ（フォルダ）を作成する|
|ls|list|今いるディレクトリの中身を調べる<br />「ls -la」というように「-la」オプションを指定することで、<br />ファイルのアクセス権限や隠しファイルも表示することができる|
|cd|change directory|階層を移動する|
|touch|-|ファイルの最終アクセス日時と最終更新日時を変更する。ファイルがない場合は新しい空のファイルを作成する|

### 使い方例
* pwd

```bash
[guest@www.masswerk.at:2]$ pwd   # 自分がいるディレクトリを表示
/home/guest
```

* mkdir

```bash
[guest@www.masswerk.at:2]$ mkdir testfolder   # 「testfolder」というディレクトリを作成
```

* ls

```bash
[guest@www.masswerk.at:2]$ ls   # 自分がいるディレクトリの中身を表示
testfolder

[guest@www.masswerk.at:2]$ ls -la   # オプションをつけてパーミッションや隠しファイルも表示
drwxr-x---  2  guest     wheel     --------  2016/01/20 10:25:18  .
drwxrwxrwx  2  root      wheel     --------  2016/01/20 10:06:30  ..
-rw-------  1  guest     users          151  2016/01/20 10:06:30  .history
drwxr-x---  2  guest     users     --------  2016/01/20 10:25:18  testfolder
```

* cd

```bash
[guest@www.masswerk.at:2]$ cd testfolder   # 「testfolder」ディレクトリの中に入る

[guest@www.masswerk.at:2]$ pwd             # ちゃんと移動できてるか確認してみる
/home/guest/testfolder
```

* touch

```bash
[guest@www.masswerk.at:2]$ touch sample.txt   # 「sample.txt」というテキストファイルを作成

[guest@www.masswerk.at:2]$ ls                 # ちゃんと作成できているか確認してみる
sample.txt
```

### 階層構造について
すべてのパソコンにはrootディレクトリと呼ばれるディレクトリが存在します。  
そのrootディレクトリから、他のディレクトリが枝分かれしていくという階層構造になっています。

<img src="http://hackers.nexseed.net/images/curriculum_images/unix_1.png" alt="フォルダの階層" style="width: 80%;">

### 階層を移動するコマンド「cd」の使い方
* 自分が今いるところから、下の階層へ移動する場合

```bash
$ cd 移動したいディレクトリ名

[guest@www.masswerk.at:2]$ cd             # いったん「home/guest」に移動
[guest@www.masswerk.at:2]$ pwd            # 現在地を確認
/home/guest/
[guest@www.masswerk.at:2]$ cd testfolder  # 1つ下の階層「testfolder」へ移動
[guest@www.masswerk.at:2]$ pwd            # 現在地を確認
/home/guest/testfolder
```

* 自分が今いるところから、1つ上の階層へ移動する場合

```bash
$ cd ../

[guest@www.masswerk.at:2]$ pwd            # 現在地を確認
/home/guest/testfolder
[guest@www.masswerk.at:2]$ cd ../         # 1つ上の階層「guest」へ移動
[guest@www.masswerk.at:2]$ pwd            # 現在地を確認
/home/guest/
```

### 絶対パスと相対パス
ディレクトリの場所を指し示す方法として、 **絶対パス** と **相対パス** という2種類の指定方法があります。

#### 絶対パス
rootディレクトリから見た指定方法で、/(スラッシュ）から始まるパスのことを指します。  
どの場所からでも入力するパスは変わらない指定方法です。

例）「guest」ディレクトリへ移動する場合

```bash
[guest@www.masswerk.at:2]$ cd /home/guest
```

#### 相対パス
自分がいる現在地のディレクトリから見た指定方法で、同じディレクトリの場所でも自分がいる場所によってパスが変わります。

例）現在「/home/guest」にいる前提で、図の「etc」へ移動する場合

* 絶対パスの場合

```bash
[guest@www.masswerk.at:2]$ cd             # いったん「home/guest」に移動
[guest@www.masswerk.at:2]$ pwd            # 現在地を確認
/home/guest/
[guest@www.masswerk.at:2]$ cd /etc        # 絶対パス指定で「/etc」へ移動
```

* 相対パスの場合

```bash
[guest@www.masswerk.at:2]$ cd             # いったん「home/guest」に移動
[guest@www.masswerk.at:2]$ pwd            # 現在地を確認
/home/guest/
[guest@www.masswerk.at:2]$ cd ../../etc   # 相対パスで「/etc」へ移動
```

### パーミッション
UNIXではファイルのアクセスに対してアクセス権限が設定できるようになっており、ファイルの「読み」「書き」「実行」権限を、「ユーザ」「同グループ内ユーザ」「その他のユーザ」ごとに細かく設定することができます。  
この権限の付与を **パーミッション** といいます。

例えば、mkdirコマンドで作成した「testfolder」のパーミッションを見てみましょう。  
「ls」コマンドに「-la」オプションをつけることで、パーミッションを確認することができます。

```bash
[guest@www.masswerk.at:2]$ cd              # いったん「home/guest」に移動
[guest@www.masswerk.at:2]$ ls -la          # パーミッションを確認
drwxr-x---  2  guest     wheel     --------  2016/01/20 10:35:10  .
drwxrwxrwx  2  root      wheel     --------  2016/01/20 10:34:58  ..
-rw-------  1  guest     users          275  2016/01/20 10:34:58  .history
drwxr-x---  2  guest     users     --------  2016/01/20 10:36:27  testfolder
```

「testfolder」の情報を抜き出してみると、

```
drwxr-x---  2  guest     users     --------  2016/01/20 10:36:27  testfolder
```

とあります。  
この「drwxr-x---」という10桁の文字列の部分がパーミッションになります。

パーミッションの割り当ては次のとおりです。

|ファイルタイプ|ユーザ|同グループ内ユーザ|その他ユーザ|
|:--:|:--:|:--:|:--:|
|d|rwx|r-x| --- |

ファイルタイプはディレクトリの場合「d」と表示されます。  
それ以降の9文字は、3文字ずつユーザに対しての権限設定になります。

3文字の内訳は次のとおりです。

|文字|アクセス権限|
|:--:|:--:|
|r|読み込み|
|w|書き込み|
|x|実行|
|-|なし|

以上のことから、「testfolder」ディレクトリのパーミッション権限は次のようになります。

||読み込み|書き込み|実行|
|:--|:--:|:--:|:--:|
|ユーザ|○|○|○|
|同グループ内ユーザ|○|-|○|
|その他ユーザ|-|-|-|

#### パーミッションの設定
パーミッションについては、コマンドを使って設定することができます。  
パーミッションは次のとおり数値を持っており、この数値を合算して使います。

|文字|アクセス権限|数値|
|:--:|:--:|:--:|
|r|読み込み|4|
|w|書き込み|2|
|x|実行|1|
|-|なし|0|

例えば「testfolder」のパーミッションは、「rwxr-x---」なので、「750」になります。

|権限|数値|
|:--:|:--:|
|rwx|7|
|rw-|6|
|r-x|5|
|r--|4|
|-wx|3|
|-w-|2|
|--x|1|
|---|0|

コマンドでパーミッションを変更する場合は、次の「 **chmod** 」コマンドを使います。

```bash
$ chmod [オプション] [パーミッション] [変更するファイル・ディレクトリ名]
```

オプションで「-R」を指定すると、変更するディレクトリ以下すべてのファイルやディレクトリもパーミッションが変更されます。

```bash
$ chmod -R 775 testfolder
```

例）「testfolder」ディレクトリ以下のパーミッションを「775（rwxrwxr-x）」に変更する場合

```bash
[guest@www.masswerk.at:2]$ chmod -R 775 testfolder       # パーミッション変更
[guest@www.masswerk.at:2]$ ls -la                        # 変更されたか確認
drwxr-x---  2  guest     wheel     --------  2016/01/20 10:35:10  .
drwxrwxrwx  2  root      wheel     --------  2016/01/20 10:34:58  ..
-rw-------  1  guest     users          304  2016/01/20 10:34:58  .history
drwxrwxr-x  2  guest     users     --------  2016/01/20 10:36:27  testfolder
```

### viエディタ
CUIでは画面がないため、テキストファイルや設定ファイル等もコマンドで操作する必要があります。  
ファイルを編集する場合は、**viコマンド** を使用します。

例）「nexseed.txt」というファイルを編集する場合（もしファイルがない場合は新規作成になる）

```bash
$ vi nexseed.txt
```

例えばtouchコマンドで作成した「sample.txt」を編集する場合は、次のコマンドを実行します。

```Bash
[guest@www.masswerk.at:2]$ cd /home/guest/testfolder  # sample.txtがあるディレクトリへ移動
[guest@www.masswerk.at:2]$ vi sample.txt              # viコマンドでsample.txtを開く
```

そうすると次のような画面が表示されます。（touchコマンドで空のファイルを作ったので、中身は空っぽです）

<img src="http://hackers.nexseed.net/images/curriculum_images/unix_2.png" alt="CUI操作" style="width: 80%;">

書き込む時は「I」キーを押下し、書き込みモードにして編集します。

<img src="http://hackers.nexseed.net/images/curriculum_images/unix_3.png" alt="CUI操作" style="width: 80%;">

編集が完了したら、「esc」キーを押下し、「:wq」と入力して「Enter」を押します。

<img src="http://hackers.nexseed.net/images/curriculum_images/unix_4.png" alt="CUI操作" style="width: 80%;">

viエディタは、編集モードとコマンドモードがあります。  
「I」キーを押すと編集モードになり、「esc」キーを押すとコマンドモードになります。

コマンドモードでは次の操作ができます。

|キー|操作内容|
|:--|:--|
|:w|書き込み保存|
|:q|エディタ終了|
|:wq|書き込みを保存し、エディタを終了|
|:q!|エディタを強制終了|

編集モード中に困ったことが起きた場合は、まず落ち着いて「esc」キーを押下してコマンドモードにし、「:q!」と入力して上書きせずにいったんviエディタを閉じることをオススメします。
