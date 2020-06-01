## Source Tree
Gitでのバージョン管理は、ターミナルなどのコマンドラインにコマンドを打ち込んで操作することが可能ですが、直感的な操作で、操作結果をビジュアルとして表示してくれる操作（GUI）の方が最初は分かりやすいです。  
今回は、Gitの操作をGUIで簡単に操作できるSource Treeの使い方を紹介します。

## Source Treeでリポジトリの作成
これから管理するローカルリポジトリを作成します。  
Source Treeを起動し、表示されたSource Treeウィンドウの「+新規リポジトリ」ボタンをクリックして、「ローカルリポジトリを作成」を選択します。。

<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_1.png" alt="Sourcetree" style="width: 60%;">

保存先のパスと名前を指定して、「作成」ボタンをクリックします。

<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_2.png" alt="sourcetree" style="width: 60%;">

作成したリポジトリをダブルクリックし、Source Treeの画面上に現在のリポジトリに存在するファイルが表示されているかどうか確認しましょう。

<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_3.png" alt="sourcetree" style="width: 60%;">


## ファイルをコミットする
リポジトリに新しいファイルを作成した場合、あるいは変更した場合は、その変更を反映させるためにcommitする必要があります。
commitする前に、まずは作成／変更したファイルをインデックスに追加します。

ファイルを作成／変更すると、変更されたファイルが「作業ツリーのファイル」のところに表示されるので、チェックを入れてインデックスに追加します。

<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_4.png" alt="sourcetree" style="width: 60%;">

ファイルをインデックスに追加したら、ツールバーの「コミット」アイコンをクリックします。
コミット作成画面が表示されたら、コミットメッセージを入力して「コミット」ボタンをクリックします。

<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_5.png" alt="sourcetree" style="width: 60%;">

以上でコミットが完了します。


## 履歴を見る
リポジトリにコミットされた履歴は、ログとして見ることができます。
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_6.png" alt="sourcetree" style="width: 60%;">



## リモートリポジトリへの操作
ローカルでコミットした内容をリモートリポジトリにpushします。

まず、リモートリポジトリを用意します。<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_7.png" alt="sourcetree" style="width: 60%;">

リポートリポジトリを作ったら次のような画面が表示されるので、「git@github.com:xxxxxx/yyyyyy.git」のURLをコピーしておきます。
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_8.png" alt="sourcetree" style="width: 60%;">

Source Treeを開き、「設定」アイコンをクリックして「リモート」タブの「追加」ボタンをクリックします。
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_9.png" alt="sourcetree" style="width: 60%;">

リモートの名前を「origin」にし、URLにさっきコピーしたGitHubのURLを貼り付けて「OK」をクリックします。
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_10.png" alt="sourcetree" style="width: 60%;">

「プッシュ」のアイコンをクリックし、「master」ブランチにチェックを入れて「OK」ボタンをクリックします。
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_11.png" alt="sourcetree" style="width: 60%;">

「Completed successfully」と表示されたらpush成功です。
GitHubのページを更新して、変更履歴が反映されていることを確認してください。
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_12.png" alt="sourcetree" style="width: 60%;">

GitHubのページ<br>
<img src="http://hackers.nexseed.net/images/curriculum_images/sourcetree_13.png" alt="sourcetree" style="width: 60%;">
