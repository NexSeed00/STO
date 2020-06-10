## flexbox 練習問題

### 目標
下の画像と同じ見た目になるようにstyle.cssの
「.container」と「.box」の中身を編集しましょう。
<br>

![見本](img/flexbox_hw_goal.png)

### 開始準備

1. 自分のフォルダの中に、「flexbox-hw」という名前のフォルダを作ります。
2. 「flexbox-hw」の中に、index.htmlファイルとstyle.cssファイルを作成します。
3. 以下のコードをそれぞれindex.htmlとstyle.cssに貼り付けましょう


index.html
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="container">
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
        </div>
    </main>
</body>
</html>
```

style.css
```css
* {
    margin: 0;
    padding: 0;
}
main {
    width: 100%;
    height: 500px;
    background-color: grey;
}
.container {
    /* ここを編集 */
}
.box {
    /* ここを編集 */
}
```

`.container`と`.box`の中身を考えて、上の画像と同じような見た目にしましょう。

解答例は、上のリンクのanswer.cssにあります。どうしてもわからない場合は、答えをみても構いません。<br>２回目に答えをみないで書くチャレンジをしましょう！
