# アプリの設計
## 学ぶ内容
まずはコーディングに入る前の作業として設計を実施します。

## 機能一覧
- 日記の一覧を表示する
- 日記を投稿する
- 日記を編集する
- 日記を削除する
- 日記にいいねをする
- 日記からいいねを外す
- いいねの数を表示する
- 会員登録する
- ログインする
- ログアウトする

## 画面遷移図
## ワイヤーフレーム
## ERD
## テーブル定義書
### Diaries
|  列名             |  データ型    |  NOT NULL | デフォルト | 備考   |
| ----              | ----         | ----      | ----       | ----   |
|  id               |  INT         | YES       |            |  PK    |
|  title            |  varchar(30) | YES       |            |        |
|  body             |  text        | YES       |            |        |
|  image_path       |  varchar(255)| NO        |            |        |
|  user_id          |  INT         | YES       |            |        |
|  created_at       |  TIMESTAMP   | YES       |            |        |
|  updated_at       |  TIMESTAMP   | YES       |            |        |
