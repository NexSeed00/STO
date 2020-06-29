// 1. 要素の取得
// idが()の中の要素を取得する
let btn = document.getElementById('btn-test');
let tags = document.getElementsByTagName('div');
console.log(tags);


// 要素.addEventListener('イベント', function() {
// イベントが発生したときに処理したい内容
// })


btn.addEventListener('click', function() {
  this.textContent = 'クリックされました';
  this.style.backgroundColor = 'red';
})

console.log(btn);

// その他
// querySelectorとquerySelectorAllでどんな要素も取得可能
// 取得される結果は①要素自体 or ②要素が入った配列
// .は「の」と思えばOK

// Q9
// Checkボタンがクリックされた時、
// 入力された名前をpタグに表示してください

// checkボタン(をクリック
// 1. checkボタン(要素の取得)
// 2. 1にクリックされたらというイベントを追加
let btn9 = document.querySelector('#q9-btn');
console.log(btn9);

// スコープ
// 変数の有効範囲のこと
// ローカル変数, グローバル変数

btn9.addEventListener('click', function() {
let localVal = 'hoge';

  console.log(localVal);

})

if (true) {
  let localVal = 'fuga';
  console.log(localVal);
}
// console.log(localVal);



