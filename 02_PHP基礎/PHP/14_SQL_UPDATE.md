
## UPDATE文 - データの更新
CRUD処理のUpdateにあたる部分。データベースに既に作成されたデータを更新します。また、UPDATE文は更新したいデータを絞り込むための条件を必要とします。

### 基本構文：
```SQL
UPDATE  `テーブル名` SET `カラム名１`=値１, `カラム名２`=値２... WHERE 取得条件
```

例）inquiriesテーブルに作成されたidが1のデータを更新するUPDATE文
```SQL
UPDATE  `inquiries` SET `nickname`="Masao", `email`="masao@gmail.com" WHERE `id`=1
```
↑実際にPHPMyAdminのSQLタブで1行ずつ入力・実行しましょう。

## UPDATE文の考え方
UPDATE文はINSET文とSELECT文で学んだことをそれぞれ組み合わせて考えるとわかりやすいです。  

**SET句**部分はINSET文と、**WHERE句**部分はSELECT文とまったく同じなので、新たに覚えるというよりかはこれまでの知識を応用する形で覚えておくと良いでしょう。

**※WHEREで条件を指定しないと全件更新されるので注意**
sql_update.md
sql_update.md を表示しています。
