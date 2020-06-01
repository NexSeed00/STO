
## DELETE文 - データの更新
CRUD処理のDeleteにあたる部分。データベースに既に作成されたデータを削除します。また、DELETE文は削除したいデータを絞り込むための条件を必要とします。

### 基本構文：
```SQL
DELETE FROM `テーブル名` WHERE 取得条件
```

例）inquiriesテーブルに作成されたidが1のデータを削除するDELETE文
```SQL
DELETE FROM `inquiries` WHERE `id`=1
```
↑実際にPHPMyAdminのSQLタブで1行ずつ入力・実行しましょう。

## DELETE文の考え方
DELETE文もUPDATE文と同じく、これまでSELECT文で学習した内容をそのまま応用できます。

**※WHEREで条件を指定しないと全件削除されるので注意**
sql_delete.md
sql_delete.md を表示しています。
