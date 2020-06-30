# JavaScript ToDoアプリ

## 概要
DOMの操作を用いたシンプルなTodoアプリの作成をします。

* [完成見本](https://wizardly-jennings-40d4f5.netlify.app/)

## 機能
* ユーザーはinputに文字を入力
* 「Add」をクリックすると、入力した内容が下のリストに追加される（以下タスクと呼ぶ）
* 各タスクには「Delete」ボタンがついており、クリックすると、リストから削除される。

## 作成の手順

* zipファイルのダウンロード ([クリックでDL開始](https://github.com/NexSeed00/STO/blob/master/%E7%99%BA%E5%B1%95%E5%AD%A6%E7%BF%92/JavaScript/JS_Todo/js_todo.zip?raw=true))
* HTML、CSSは用意されているので、main.jsを編集します。

1. ボタン要素を取得
2. ボタンにクリックイベントを追加する (3-15は全てこのイベント内)
3. ユーザーが入力した内容 (value) を取得し、定数に代入
4. `<li>`要素を作成
5. `<li>`にクラス（list）を追加
6. `<li>`にユーザーが入力した内容(3)を入れる
7. `<ul>`要素を取得 (todo-list)
8. 4-6で作成した`<li>`を、7で取得した`<ul>`の子要素に入れる
9. inputの中に入力された文字を消去する（値を''にする）
10. Deleteボタンを作成（機能としてはボタンですが、`<div>`要素を使います）
11. Deleteボタンのコンテンツ (文字) を指定
12. Deleteボタンにクラス (delete) を追加
13. 10-12で作成したDeleteボタンを、4-6で作成した`<li>`の子要素に入れる
14. Deleteボタンにクリックイベントを追加 (15)
15. クリックした要素 (this) を親ごと削除


## 使用するコードの復習
まだDOM操作の基本を覚えられていない方は、制作開始前におさらいしましょう。

#### 要素の取得

`document.querySelector('.クラス名')`

#### 要素の作成

`document.createElement('タグ名')`

#### 要素にクラスを追加

`要素.classList.add('クラス名')`

#### 要素のコンテンツ (文字) を編集
`要素.textContent = inputValue`

#### 子要素を追加

`親要素.appendChild(子要素)`

#### 親要素を削除

`要素.parentElement.remove();`

#### 要素のvalueを編集

`document.querySelector('#id').value = '任意のvalueの値'`

#### ある要素の親要素

`要素.parentElement`

#### 要素の削除

`要素.remove()`

#### イベントの追加
```
要素.addEventListener('click', function() {
    console.log('Hello World');
});
```
