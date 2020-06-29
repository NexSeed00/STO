# 要素の作成 / 追加

## 要素の作成
`document.createElement`

## 要素の追加
- `〇〇.insertBefore`  
- `〇〇.appendChild`


## サンプル

### HTML
```HTML
<div id="parent">
  <div id="tetsuya">てつや</div>
</div>
```

### JavaScript
```JavaScript
let michiko = document.querySelector('#parent');

// 要素の作成、追加
let akemi = document.createElement('div');
akemi.textContent = 'あけみ';
michiko.appendChild(akemi);

let masato = document.createElement('div');
masato.textContent = 'まさと';
michiko.appendChild(masato);

let atsushi = document.createElement('div');
atsushi.textContent = 'あつし';
michiko.insertBefore(atsushi, masato);

// idやClassの指定
atsushi.id = 'atsushi';
atsushi.style.color = 'blue';
atsushi.classList.add('nexseed');
```