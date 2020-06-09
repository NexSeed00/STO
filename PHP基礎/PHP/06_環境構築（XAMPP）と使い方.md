## XAMPPとは？
XAMPPとは、Webアプリケーション開発に欠かすことのできないソフトウェアやツールを、無料で一括インストールすることができるパッケージのことです。  
Webアプリケーションを作成するには、ApacheやMySQL、Webプログラミング言語（PHP、Rubyなど）が必要ですが、本来この3つのソフトウェアはそれぞれ別の団体で作成・アップデートされているため、開発する際には個別にそれぞれダウンロードとインストールをする必要があります。  

これらのソフトウェアのインストール（環境構築）は、Webアプリケーション開発初心者には難しいところがありますが、XAMPPを使うことでMacでもWindowsでも簡単に開発環境を構築することができます。しかし、XAMPPの場合、サーバの細かい設定ができないことや、サーバの構造が理解しにくいといった欠点もあります。

実際にサーバの環境構築をするところは、Webコースの方で学習していきます。
Basicコースでは、XAMPPを使って簡単にプログラミング学習の環境を準備してみましょう。

ちなみに、「XAMPP」という名前は次の頭文字を取ったものです。

* **X**：Windows, Linux, MacOS, Solarisのクロスプラットフォーム（異なるOSでも同じように使うことができる）
* **A**：Apache
* **M**：MySQL（MariaDB） ※MariaDBは、MySQLから派生したデータベース管理システム
* **P**：PHP
* **P**：Perl（PHPと同じく、サーバー側で動くプログラミング言語）

## XAMPPのダウンロードとインストール
[公式サイト](https://www.apachefriends.org/jp/index.html)でインストーラをダウンロードします。  
それぞれのOSに合ったインストーラをダウンロードしてください。
<h3>Mac編</h3>
https://www.youtube.com/embed/k5kGmWOdmrE
<br>
<h3>Windows編</h3>
https://www.youtube.com/embed/FHFeISydZ7k
<br><br><br><br>
<h4>手順</h4>
<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_1.png" alt="XAMPP" style="width: 80%;">

ダウンロードしたインストーラをダブルクリックして起動し、XAMPPをインストールしてください。  
Macの場合、インストーラをダブルクリックで開いた状態で、XAMPPフォルダをApplicationsフォルダにドラッグ＆ドロップすることでインストールすることができます。

アプリケーションフォルダにXAMPPフォルダが作成されていることを確認してください。

<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_2.png" alt="XAMPP" style="width: 80%;">

## XAMPPの起動
XAMPPフォルダの中にある「manager-osx.app」をダブルクリックして開きます。このアプリケーションが、XAMPPの管理画面になります。

<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_3.png" alt="XAMPP" style="width: 80%;">

開くと次のような画面が表示されるので、上に並んでいる３つのタブのうち、「Manager Servers」をクリックします。
<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_4.png" alt="XAMPP" style="width: 80%;">

<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_5.png" alt="XAMPP" style="width: 80%;">

画面の下にある「Start All」をクリックして、XAMPPの環境を起動します。全てグリーンのアイコンに変わったら起動完了です。

<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_6.png" alt="XAMPP" style="width: 80%;">

<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_7.png" alt="XAMPP" style="width: 80%;">


## XAMPPの確認
以前作成したboltのページを、XAMPPの環境で表示してみましょう。

XAMPPフォルダ＞htdocsフォルダの中にboltフォルダをコピーしてください。

<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_8.png" alt="XAMPP" style="width: 80%;">

コピーしたboltフォルダを右クリックして「情報を見る」を選択し、フォルダの権限を確認してください。もし「アクセス不可」の状態になっていたら、「読み／書き」の状態に変更しましょう。

<img src="http://hackers.nexseed.net/images/curriculum_images/xampp_9.png" alt="XAMPP" style="width: 80%;">

[http://localhost/bolt/theme/](http://localhost/bolt/theme/)が表示されたら成功です！


## XAMPPの使い方
XAMPP環境を使う時は、表示したいページをXAMPP>htdocsフォルダに設置します。
また、ページにアクセスする際はURLのドメインが「localhost」になります。

例えば、htdocsフォルダの直下に「test.html」というHTMLファイルを作って表示させたい場合は、「http://localhost/test.html」とアクセスすることになります。
