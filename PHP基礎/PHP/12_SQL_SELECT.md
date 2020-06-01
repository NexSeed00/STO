
## SELECT文 - データの読込（取得）
CRUD処理のReadにあたる部分。データベースから必要なデータを取得（読込）します。また、SELECT文は取得したいデータを絞り込むための条件を必要とします。

### 基本構文：
```SQL
SELECT `①取得したいカラム名` FROM `②テーブル名` WHERE ③取得条件
```

##### トピック
\` ← シングルクォートを逆にしたようなこの記号のことを**アクサングラーブ**と言います。日本語キーの場合は`Shift + @`、英字キーの方は一番左上にあるキーを押すことで入力できます。  
SQL文では、カラム名とテーブル名は基本このアクサングラーブで囲います。  

※アクサングラーブは実際には省略可能ですが、学習中はテーブル名やカラム名などが目立つよう入力するようにします。

例）inquiriesテーブルからデータを全件取得するSELECT文  
```SQL
SELECT * FROM `inquiries` WHERE 1

SELECT `code`,`nickname`,`email` FROM `inquiries` WHERE 1
```
↑実際にPHPMyAdminのSQLタブで1行ずつ入力・実行しましょう。

#### ①取得したいカラム名
カンマで区切ることで複数選択可。また、*を使うことで全カラム選択という意味になります。

#### ②テーブル名
そのまま対象となるテーブル名を入力

#### ③取得条件
**基本構文：**  
```SQL
`比較対象カラム` 演算子 値
```

例）
```SQL
`code` = 1  
`nickname` = '野原ひろし'
`code` >= 2  
```

例）inquiriesテーブルから様々な条件でデータを取得

```SQL
SELECT * FROM `inquiries` WHERE `code` = 3

SELECT * FROM `inquiries` WHERE `code` >= 2

SELECT * FROM `inquiries` WHERE `nickname` = '野原ひろし'

SELECT * FROM `inquiries` WHERE `email` = 'hiroshi@gmail.com'

SELECT * FROM `inquiries` WHERE `content` = 'ほげほげ'
```
↑実際にPHPMyAdminのSQLタブで1行ずつ入力・実行しましょう。

また、1を指定することで *無条件 = 全件* という条件になります。


## データの読込（取得）処理は2種類

1. 複数件取得
1. 一件取得

※全件取得は複数件に含まれる。

2の一件取得の場合の条件に重宝されるのが、PRIMARY KEYとA_Iの設定がされたidなどの一意（ユニーク）なカラムになります。  
このカラムは絶対に重複しない値になるので、条件にした場合は一件のデータのみヒットするようになるためです。
sql_select.md
sql_select.md を表示しています。
