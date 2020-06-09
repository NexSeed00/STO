# PHP + MySQLを利用したTODOアプリの作成

## 実施する内容
- TODOアプリの作成(チーム開発)

## 要件
### 機能一覧
#### 必須
- タスクの作成ができる
  - 投稿した日を自動でDBに保存する
- タスクの一覧表示ができる
- タスクの編集ができる
- タスクの削除ができる

#### 任意
- 表示される順番を登録日が新しい順にする
- タスクの検索ができる
- 認証機能を実装する
  - サインアップ機能
  - サインイン機能
  - サインアウト機能

### テーブル定義
### テーブル名: tasks
| 列名        | データ型    | NOT NULL | デフォルト | 備考                 |
| ----------- | ----------- | -------- | ---------- | -------------------- |
| id          | INT         | YES      |            | PK                   |
| title       | varchar(30) | YES      |            | タスクの題名が入る   |
| contents    | varchar(30) | NO       |            | タスクの詳細が入る   |
| created_at  | TIMESTAMP   | NO       |            | タスクの登録日       |

### テーブル名: users
| 列名        | データ型    | NOT NULL | デフォルト | 備考                 |
| ----------- | ----------- | -------- | ---------- | -------------------- |
| id          | INT         | YES      |            | PK                   |
| email       | varchar(30) | NO       |            |                      |
| password    | varchar(90) | NO       |            |                      |
| created_at  | TIMESTAMP   | NO       |            | アカウントの登録日   |


## その他
- エラー文は必ず読むようにしましょう。
- var_dumpを活用しましょう。
- すべてをまとめてやらずに1つ1つ順番に実施しましょう
- 1つ実装が終わったら必ず動作確認をしましょう。


## ファイル内容
### タスク関連の処理
- index.php: 一覧ページ
- create.php: 新規投稿ページ
- store.php: 保存処理
- edit.php: 編集ページ
- update.php: 更新処理
- delete.php: 削除処理
- fundtion.php: 関数置き場
- dbconnect.php: DB接続処理

### 認証関連の処理
- signupForm.php: ユーザー新規登録ページ
- signup.php: 新規登録処理
- signinForm.php: ユーザーサインインページ
- signin.php: アカウント登録処理
- signout.php: サインアウト処理

### DB保存関連の処理
- Models/Model.php: 共通の処理
- Models/Task.php: タスク関連のDB処理
- Models/User.php: ユーザー関連のDB処理