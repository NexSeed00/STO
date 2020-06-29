# イベントの登録

イベントを登録する際にやることは大きくわけると3つだけです。  
1. イベントを登録する要素を取得する
  - `document.querySelector` etc
2. イベントを登録
  - `addEventListener`
3. イベントの内容を書く
  - 文字の色を変更
  - テキストを変更
  - アラートを表示
  - etc

## サンプル

### HTML
```HTML
  <input type="text" id="input-text">
  <button id="btn">ボタン</button>
```

### JavaScript
```JavaScript
let text = document.querySelector('#text');
text.addEventListener('click', function () {
  this.style.color = 'blue';
  this.style.fontSize = '40px';
})

text.addEventListener('mouseover', function () {
  this.style.color = 'pink';
  this.style.fontSize = '20px';
})

text.addEventListener('mouseleave', function () {
  this.style.color = '';
})

let input = document.querySelector('#input-text');
input.addEventListener('change', function () {
  console.log(this.value);
  alert('入力欄が変更されました');
})

let btn = document.querySelector('#btn');
console.log(btn);

btn.addEventListener('click', function () {
  text.textContent = input.value;
})
```



