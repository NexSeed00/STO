# Bootstrapの使い方

Bootstrapとは、WEBページでよく使われるフォーム、ボタン、メニューなどがテンプレートとして用意されているCSSのフレームワークです。
また、レスポンシブにも対応しています。

ここでは、以下のシンプルなページを作りながらBootstrapの基礎を学んでいきます。

![Bootstrap](img/bs23.png)


1. 準備
2. 導入の流れ
3. クラス
4. レスポンシブ
5. 組み合わせ

## 1. 準備

以下のリンクからBootstrapの公式ページを開いてください。
- [Bootstrap](https://getbootstrap.com/)

「Get started」をクリックします。

![Bootstrap](img/bs1.png)

赤く囲った２つのリンクをhtmlファイルの中にコピーします。


![Bootstrap](img/bs2.png)

* CSSは`<head>`の中
* JSは`<body>`の中、一番下

![Bootstrap](img/bs3.png)

これで実際にBootstrapを使う準備ができました。

<br>
<br>

## 導入の流れ

Bootstrapのページに戻って左のバーから`Component`をクリックしてください。

![Bootstrap](img/bs4.png)

中にはたくさんの`Component`が入っています。
これらをコピー・編集・様々なコンポーネントを組み合わせて使うことで、簡単にきれいな見た目のウェブサイトが作れるというがBootstrapを使う利点です。

`Navbar`をクリックします。
`Navbar`とはNavigation barの略で、ページのトップにあり、他のページへのリンクなどがある横長の要素です。
Bootstrapのページでは紫色の部分がそれにあたります。

![Bootstrap](img/bs5.png)

`Navbar`を開くと様々な種類の`Navbar`が載っています。
下の画像と同じものを見つけて、`Copy`をクリックします。

![Bootstrap](img/bs6.png)

`<body>`の一番上にコピーしたものを貼り付けましょう。


![Bootstrap](img/bs7.png)


## クラス

ブラウザで確認すると、Navbarが追加されているのがわかります。
白の背景にグレーでは見づらいので、色を変えてみましょう。

![Bootstrap](img/bs8.png)

`<nav>`タグの中のクラス、`navbar-light bg-light`を`navbar-dark bg-dark`に変更しましょう。


![Bootstrap](img/bs9.png)

すると色が変更されているのがわかります。

![Bootstrap](img/bs10.png)

このように、**Bootstrapでは、クラスに対応するCSSが用意されていて、クラスを変更することで色や大きさなどを変えることができます。**

今回はdarkという色を使いましたが、Bootstrapには色の名前が用意されています。
- [色の一覧](https://getbootstrap.com/docs/4.4/utilities/colors/)

例えば、`bg-dark`としたのを`bg-info`とすれば水色になります。

<br>
<br>

## レスポンシブ

冒頭の説明でもありましたが、Bootstrapは全ての要素が最初からレスポンシブに対応しています。
画面の幅を狭めて確認してみます。
先ほどまでに横に並んでいた文字がなくなり３本線の記号に変わっています。
これを「ハンバーガーメニュー」と呼びます🍔

![Bootstrap](img/bs11.png)

<br>
ハンバーガーメニューをクリックすると下に展開され、隠れていた先ほどのリンクが出たきます。これは「ドロップダウンメニュー」と呼ばれるものです。

![Bootstrap](img/bs12.png)

<br>
次に画像にあるような`Card`を取り入れてみたいと思います。

![Bootstrap](img/bs13.png)

<br>
`Card`の中から画像にあるものと同じものを見つけて、コピーし、`index.html`の中に貼り付けます。

![Bootstrap](img/bs14.png)

<br>
Bootstrapのウェブページ内に載っていたサンプルと若干違う見た目になってしまいます。
まず横幅が画面いっぱいに広がっています。

![Bootstrap](img/bs15-1.png)
この場合、要素を
```html
    <div class="container">

    </div>
```
の中に入れることで、画面の横にスペースを作った見た目になります。
![Bootstrap](img/bs15-2.png)

<br>

`card`と`navbar`の間に隙間がなかったので、`style.css`に以下のCSSを追加しておきます。

```css
.container {
    margin-top: 30px;
}
```

これで配置がきれいになりました。
次に`<img>`タグのリンクがデフォルトでは`"..."`になっているので、正しいリンクを貼りましょう。

![Bootstrap](img/bs16.png)

<br>
以下のリンクで好きな画像を見つけます。
画像を検索することができます。

https://unsplash.com/


![Bootstrap](img/bs17.png)

<br>
好きな画像をクリックすると拡大されて表示するので、画像のURLをコピーします。

![Bootstrap](img/bs18.png)

<br>
コピーしたURLを`<img>`タグの`src`に貼り付けます。

![Bootstrap](img/bs19.png)

<br>
貼り付けた画像が表示されました。

![Bootstrap](img/bs20.png)

<br>
<br>

## 組み合わせ

最後に以下のようなボタンをカードの中に入れてみましょう。
画像内で青くハイライトされている部分がボタン要素なのでコピーしてください。

![Bootstrap](img/bs21.png)

<br>

`<div class="card h-100">`内の`<p>`タグの下に貼り付けます。

![Bootstrap](img/bs22.png)

<br>
ボタンをカード内に取り入れることができました。

![Bootstrap](img/bs23.png)

<br><br>
このように　Bootstrapには、特定のクラスに対応するCSSが用意されており、それを組み合わせることで、スピーディにきれいな見た目のウェブサイトを作ることができます。


ここではBootstrapの導入の仕方と、ごく一部のコンポーネントを紹介しました。
さらに学習したい人は、Bootstrapウェブサイト内をみて、自分で色々と試してみましょう。