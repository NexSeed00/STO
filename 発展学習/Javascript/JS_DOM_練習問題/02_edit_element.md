# 要素を編集する

## 要素の修正方法一覧
- テキストを取得/変更する
- スタイルを変更する
- CLASSを追加する
- CLASSを削除する
- inputタグの値を変更/取得する

## サンプルHTML
```HTML
<ul>
  <li id="red">赤</li>
  <li id="blue" class="red">ブルー</li>
  <li id="green">グリーン</li>
</ul>
<input type="text" id="input-text">
```

## テキストを取得/変更する
```JavaScript
let blueEl = document.getElementById('blue');
// テキストを取得
let text = blueEl.textContent;
console.log(text);

// テキストを変更
blueEl.textContent = '青';
```

## スタイルを変更する
```JavaScript
blueEl.style.color = 'blue';
```

## CLASSを追加する
```
blueEl.classList.add('blue');
```

## CLASSを削除する
```
blueEl.classList.remove('red');
```

## inputタグの値を変更/取得する
```JavaScript
let input = document.querySelector('#input-text');

// 入力欄の値を変更
input.value = "test";

// 入力欄の値を取得
console.log(inputText);
```