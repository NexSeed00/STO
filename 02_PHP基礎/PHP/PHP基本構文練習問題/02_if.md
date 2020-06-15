# 条件分岐

11. 変数 x、y にそれぞれ任意の数値を代入し、x が y より大きい（超過）場合に、  
「xはyより大きい。」という文を表示するプログラムを作成してください。

<details><summary>回答例</summary><div>
		
```
$x = 10;
$y = 2;
	
if ($x > $y) {
　　echo $x . 'は' . $y . 'より大きい';
}
```
		
</div></details>
	

<br>
	
12.  変数 x、y にそれぞれ任意の数値を代入し、x が ｙ 以上の場合には「xはy以上」、  
x が y より小さい（未満）場合には「xはyより小さい」と表示するプログラムを作成してください。

<details><summary>回答例</summary><div>
		
```
$x = 10;
$y = 20;
	
if ($x > $y) {
　　echo $x . 'は' . $y . 'より大きい';
} else {
　　echo $x . 'は' . $y . 'より小さい';
}
```
		
</div></details>
	

<br>
	
13.  変数 x、y にそれぞれ任意の数値を代入し、x が ｙ より大きい（超過）場合には「xはyより大きい」、  
x が y より小さい（未満）場合には「xはyより小さい」、x と y が等しい場合には「xとyは等しい」と表示するプログラムを作成しなさい。

<details><summary>回答例</summary><div>
		
```
$x = 10;
$y = 10;
if ($x > $y) {
　　echo $x . 'は' . $y . 'より大きい';
} elseif ($x === $y) {
　　echo $x . 'と' . $y . 'は等しい';
} else {
　　echo $x . 'は' . $y . 'より小さい';
}
```
		
</div></details>
	

<br>
	
14. 変数xに任意の数値を代入し、それが偶数か奇数かを判定するプログラムを作成してください。   
奇数の場合は、「奇数です」、偶数の場合は「偶数です」と出力してください。

<details><summary>回答例</summary><div>
		
```
$x = 10;

if ($x % 2 === 0) {
　　echo '偶数です';
} else {
　　echo '奇数です';
}
```
		
</div></details>
	

<br>
	
15. 変数xに任意の数値を代入し、それが3の倍数か5の倍数かを判定するプログラムを作成してください。   
3の倍数の場合は、「3の倍数です」、5の倍数の場合は「5の倍数です」、それ以外の場合は、「3と5の倍数以外です」と出力してください。

<details><summary>回答例</summary><div>
		
```
$x = 4;
		
if ($x % 3 == 0) {
　　echo '3の倍数です';
} else if ($x % 5 == 0) {
　　echo '5の倍数です';
} else {
　　echo '3と5の倍数以外です';
}
```
		
</div></details>
	

<br>
	
16. 変数xに任意の数値を代入し、それが10以上かつ20以下かを判定するプログラムを作成してください。   
10以上かつ20以下の場合は、「10以上かつ20以下です」と出力してください。

<details><summary>回答例</summary><div>
		
```
$x = 14;
	
if (10 <= $x && $x <= 20) {
　　echo '10以上かつ20以下です';
}
```
		
</div></details>
	

<br>
	
17. 変数xに任意の数値を代入し、それが100以上または10以下かを判定するプログラムを作成してください。   
100以上または10以下の場合は、「100以上または10以下です」と出力してください。

<details><summary>回答例</summary><div>
		
```
var x = 111;
	
if (100 <= $x || $x <= 10) {
　　echo '100以上または10以下です';
}
```
		
</div></details>
	

<br>
	
18. 変数xに「男」または「女」を代入し、以下の表通り出力するプログラムを作成してください。   
（※switch文を使用すること）

 | xの値    | 出力内容 |
 | -------- | -------- |
 | 男       | male     |
 | 女       | female   |
 | 上記以外 | ???      |

<details><summary>回答例</summary><div>
		
```
$x = "女";
	
switch ($x) {
    case "男":
        echo 'male';
        break;
    case "女":
        echo 'female';
        break;
    default:
        echo '???';
        break;
}
```
		
</div></details>
	

<br>
	
19. 変数xに任意の月の数値（1〜12）を代入し、その月を英語で出力するプログラムを作成してください。   
（※switch文を使用すること）

 | 月       | 出力内容         |
 | -------- | ---------------- |
 | 1        | January          |
 | 2        | February         |
 | 3        | March            |
 | 4        | April            |
 | 5        | May              |
 | 6        | June             |
 | 7        | July             |
 | 8        | August           |
 | 9        | September        |
 | 10       | October          |
 | 11       | November         |
 | 12       | December         |
 | 上記以外 | 月が存在しません |

<details><summary>回答例</summary><div>
		
```
$x = 4;
	
switch ($x) {
    case 1:
        echo 'January';
	break;
    case 2:
        echo 'February';
        break;
    case 3:
        echo 'March';
        break;
    case 4:
        echo 'April';
        break;
    case 5:
        echo 'May';
        break;
    case 6:
        echo 'June';
        break;
    case 7:
        echo 'July';
        break;
    case 8:
        echo 'August';
        break;
    case 9:
        echo 'September';
        break;
    case 10:
        echo 'October';
        break;
    case 11:
        echo 'November';
        break;
     case 12:
        echo 'December';
        break;
     default:
        echo '???';
        break;
    }
```
		
</div></details>
	

<br>
