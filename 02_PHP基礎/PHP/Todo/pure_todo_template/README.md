# PHP + MySQLを利用したTODOアプリの作成

## 完成品
- [ToDO](https://ooptodo.herokuapp.com/)

## 実施する内容
- TODOアプリの作成

**完成品ではサインイン機能と検索機能が備わっていますが、今回のアプリ作成においては実装の必要はありません。**

## 要件
### 機能一覧
- タスクの作成ができる(Create処理)
- タスクの一覧表示ができる（Read処理）
  - 表示される順番を登録日が新しい順に表示(任意)
- タスクの編集ができる(Update処理)
- タスクの削除ができる(Delete処理)
- タスクの検索ができる(任意)

### テーブル定義
### テーブル名: tasks
| 列名        | データ型    | NOT NULL | デフォルト | 備考                 |
| ----------- | ----------- | -------- | ---------- | -------------------- |
| id          | INT         | YES      |            | PK                   |
| title       | varchar(30) | YES      |            | タスクの題名が入る   |
| contents    | varchar(30) | NO       |            | タスクの詳細が入る   |
| created_at  | TIMESTAMP   | NO       |            | タスクの登録日       |


## その他
- エラー文は必ず読むようにしましょう。
- var_dumpを活用しましょう。
- すべてをまとめてやらずに1つ1つ順番に実施しましょう
- 1つ実装が終わったら必ず動作確認をしましょう。

## ファイル内容
- index.php: 一覧ページ
- create.php: 新規投稿ページ
- store.php: 保存処理
- edit.php: 編集ページ
- update.php: 更新処理
- delete.php: 削除処理
- fundtion.php: 関数置き場
- dbconnect.php: DB接続処理
- todo.sql: テーブル作成のSQL文

## 準備
- [こちら](https://github.com/NexSeed00/STO/blob/master/02_PHP%E5%9F%BA%E7%A4%8E/PHP/Todo/pure_todo_template.zip?raw=true)をクリックし、テンプレートをダウンロードします。
- ダウンロードしたフォルダをhtdocsの中に保存しましょう。
- phpmyadminを立ち上げ、DB名:pure_php, utf8mb4 general ci でDBを作成しましょう。
- phpmyadminでテーブルを作成しましょう。作成方法は以下の二通りあります。
  - エディタでダウンロードしたフォルダを開き、todo.sqlファイル内のコードを全てコピーし、phpmyadminのSQLタブに貼り付け、実行する方法
  - phpmyadminのインポートタブからtodo.sqlファイルを選択し、実行をする方法 
- エディタでダウンロードしたフォルダを開きましょう。
  - dbconnect.phpを開いてください。
  - `$dbname = "todo";`を`$dbname = "pure_todo";`と書き換えましょう。

以上で準備は整いました。<br>
上記にある**見本**と見比べながら、作成していきましょう。

## To doアプリ作成手順書
下記に作成の手順、ヒントを記載しています。是非、確認してみてください。

- [こちら](https://github.com/NexSeed00/STO/blob/master/02_PHP%E5%9F%BA%E7%A4%8E/PHP/Todo/Todo.pdf)を
クリック

- [ダウンロード](https://github.com/NexSeed00/STO/blob/master/02_PHP%E5%9F%BA%E7%A4%8E/PHP/Todo/Todo.pdf.zip?raw=true)
