# 要素の削除
- `〇〇.remove()`
- `〇〇.removeChild()`

## サンプル
### HTML
```HTML
  <div id="room">
    <div id="ant">あり</div>
    <div id="cockroach">ゴキブリ</div>
    <div id="flies">コバエ</div>
  </div>
```

### JavaScript
```JavaScript
let ant = document.querySelector('#ant');
ant.remove();

let room = document.querySelector('#room');
room.removeChild(room.firstElementChild);
```