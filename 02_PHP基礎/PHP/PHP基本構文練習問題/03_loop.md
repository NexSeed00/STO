# 繰り返し

21. 「hoge」という文字を10回出力するプログラムを作成してください。

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i <= 10; $i++) {
    echo 'hoge';
    echo '<br>';
}
```
		
</div></details>
	

<br>
	
22. 1から10までの数字を出力するプログラムを作成してください。

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i <= 10; $i++) {
    echo $i;
    echo '<br>';
}
```
		
</div></details>
	

<br>
	
23. 九九、二の段を表示するプログラムを作成してください。

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i < 10; $i++) {
    echo $i * 2;
    echo '<br>';
}
```
		
</div></details>
	

<br>
	
24. 1から100までの数字の中から偶数のみを出力するプログラムを作成してください。

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 === 0) {
        echo $i;
        echo '<br>';
    }
}
```
		
</div></details>
	

<br>

25. 1から100までの数字を出力するプログラムを作成してください。  
ただし、数値が奇数の場合は「奇数です」と出力してください。

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 !== 0) {
        echo '奇数です';
    } else {
        echo $i;
    }
	echo '<br>';
    }
```
		
</div></details>
	

<br>
	
26. 1から100までの3の倍数を出力するプログラムを作成してください。  

<details><summary>回答例</summary><div>
		
```
    for ($i = 1; $i <= 100; $i++) {
        if ($i % 3 === 0) {
	    echo $i;
	    echo '<br>';
	}
    }
```
		
</div></details>
	

<br>
	
27. 1から100までの5の倍数を出力するプログラムを作成してください。  

<details><summary>回答例</summary><div>
		
```
    for ($i = 1; $i <= 100; $i++) {
        if ($i % 5 === 0) {
	    echo $i;
	    echo '<br>';
	}
    }
```
		
</div></details>
	

<br>
	
28. 1から100までの3の倍数かつ5の倍数を出力するプログラムを作成してください。  

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0) {
	echo $i;
        echo '<br>';
    }
}
```
		
</div></details>
	

<br>
	
29. 1から100までの数字を出力するプログラムを作成してください。  
ただし、3の倍数の場合は数の代わりに｢Fizz｣と出力してください。

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0) {
        echo 'Fizz';
    } else {
        echo $i;
    }
        echo '<br>';
}
```
		
</div></details>
	

<br>
	
30. 1から100までの数字を出力するプログラムを作成してください。  
ただし、3の倍数の場合は数の代わりに｢Fizz｣、5の倍数のときは｢Buzz｣、3と5両方の倍数の場合には｢FizzBuzz｣と出力してください。

<details><summary>回答例</summary><div>
		
```
for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0) {
        echo 'FizzBuzz';
    } elseif ($i % 5 === 0) {
        echo 'Buzz';
    } elseif ($i % 3 === 0) {
        echo 'Fizz';
    } else {
        echo $i;
    }
        echo '<br>';
}

```
		
</div></details>
	

<br>
	
