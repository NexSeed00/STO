# 要素の取得

## 要素の取得方法一覧
- IDを指定して要素を取得
- CLASSを指定して要素を取得
- タグ名を指定して要素を取得
- CSSセレクタを指定して要素を取得（1つだけ）
- CSSセレクタを指定して要素を取得（マッチする要素すべて）
- 親要素を取得
- 子要素を取得

## IDを指定して要素を取得
```JavaScript
document.getElementById('id名');
```
	
例: idがblueの要素を取得する
	
```HTML
<ul>
  <li id="red">赤</li>
  <li id="blue">ブルー</li>
  <li id="green">グリーン</li>
</ul>
```
	
```JavaScript
let blueEl = document.getElementById('blue');
console.log(blueEl);
```	

## CLASSを指定して要素を取得
```JavaScript
document.getElementsByClassName('class名')
```

例: classがgreenの要素を取得する
	
```HTML
<ul>
  <li class="red">赤</li>
  <li class="blue">ブルー</li>
  <li class="green">グリーン1</li>
  <li class="green">グリーン2</li>
</ul>
```
	
```JavaScript
let greenEl = document.getElementsByClassName('green');
console.log(greenEl);
```	

## タグ名を指定して要素を取得
```JavaScript
document.getElementsByTagName('タグ名');
```
	
例: タグがliの要素を取得する
	
```HTML
<ul>
  <li id="red">赤</li>
  <li id="blue">ブルー</li>
  <li id="green">グリーン</li>
</ul>
```
	
```JavaScript
let liEl = document.getElementsByTagName('li');
console.log(liEl);
```	



## CSSセレクタを指定して要素を取得（1つだけ）
```JavaScript
document.querySelector('セレクタ');
```
	
例: idがboxの中の、classがcolorの要素を取得(先頭の1つだけ)
	
```HTML
<ul id="box">
  <li class="color">赤</li>
  <li class="color">ブルー</li>
  <li class="color">グリーン</li>
</ul>
```
	
```JavaScript
let color = document.querySelector('#box .color');
console.log(color);
```	

## CSSセレクタを指定して要素を取得（マッチする要素すべて）
```JavaScript
document.querySelectorAll('セレクタ');
```
	
例: idがboxの中の、classがcolorの要素を取得(マッチする要素すべて)
	
```HTML
<ul id="box">
  <li class="color">赤</li>
  <li class="color">ブルー</li>
  <li class="color">グリーン</li>
</ul>
```
	
```JavaScript
let colors = document.querySelectorAll('#box .color');
console.log(colors);
```	

## 親要素を取得
```JavaScript
ノード.parentElement; 
```
	
例: idがredの要素の親要素を習得
	
```HTML
<ul>
  <li id="red">赤</li>
  <li id="blue">ブルー</li>
  <li id="green">グリーン</li>
</ul>
```
	
```JavaScript
let red = document.getElementById('red');
let ul = red.parentElement;
console.log(ul);
```	

## 子要素を取得
```JavaScript
ノード.children; 
```
	
例: idがboxの要素の子要素を取得する
	
```HTML
<ul id="box">
  <li>赤</li>
  <li>ブルー</li>
  <li>グリーン</li>
</ul>
```
	
```JavaScript
let box = document.getElementById('box');
console.log(liList);
```

## 補足