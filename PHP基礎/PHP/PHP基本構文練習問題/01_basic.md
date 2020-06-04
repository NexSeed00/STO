# 基本

1. 「Hello World」と表示するプログラムを作成してください。

	<details><summary>回答例</summary><div>
		
	```
	echo "Hello World";
	```
		
	</div></details>
	

	<br>

2. 変数nameに「SeedKun」を代入し、作成した変数nameを使って以下のように表示するプログラムを作成してください。

	出力結果
		
	```
	変数nameの中身：SeedKun
	```
		
	<details><summary>回答例</summary><div>
		
	```
	$name = "SeedKun";
	// 以下2通りの方法で表示可
	echo "変数nameの中身：${name}";
	echo '変数nameの中身：' . $name;
	```
		
	</div></details>

	<br>

3. 変数lastNameと変数firstNameを作成し、任意の文字列を代入してください。  
そして、変数lastNameと変数firstNameを結合し、結果を表示してください。

	<details><summary>回答例</summary><div>
		
	```
	$lastName = "山田";
	$firstName = "太郎";
	echo $lastName . $firstName;
	```
		
	</div></details>
	
	<br>

	
1. 変数 x、y に数値 10、2 を代入し、x、yの和を計算し、結果を表示してください。

	<details><summary>回答例</summary><div>
		
	```
	$x = 10;
	$y = 2;
	echo $x + $y;
	```
		
	</div></details>
	
	<br>
	
5. 変数 x、y に数値 10、2 を代入し、x、yの差を計算し、結果を表示してください。

	<details><summary>回答例</summary><div>
		
	```
	$x = 10;
	$y = 2;
	echo $x - $y;
	```
		
	</div></details>
	
	<br>
	
6. 変数 x、y に数値 10、2 を代入し、x、yの積を計算し、結果を表示してください。

	<details><summary>回答例</summary><div>
		
	```
	$x = 10;
	$y = 2;
	echo $x * $y;
	```
		
	</div></details>
	
	<br>
	
7. 変数 x、y に数値 10、2 を代入し、x、yの商を計算し、結果を表示してください。

	<details><summary>回答例</summary><div>
		
	```
	$x = 10;
	$y = 2;
	echo $x / $y;
	```
		
	</div></details>
	
	<br>
	
8. 変数 x、y に数値 10、3 を代入し、x、yの余りを計算し、結果を表示してください。

	<details><summary>回答例</summary><div>
		
	```
	$x = 10;
	$y = 3;
	echo $x % $y;
	```
		
	</div></details>
	
	<br>
	
9. 変数 x、y に数値 11、13 を代入し、その積を変数 z に代入して z の値を表示するプログラムを作成しなさい。

	<details><summary>回答例</summary><div>
		
	```
	$x = 11;
	$y = 13;
	$z = $x * $y;
	echo $z;
	```
		
	</div></details>
	
	<br>
	
10. 変数 x に任意の数値を代入し、x を 1 乗、2 乗、3 乗した結果を表示するプログラムを作成しなさい。

	<details><summary>回答例</summary><div>
		
	```
	$x = 2;
	echo $x;
	echo $x * $x;
	echo $x * $x * $x;
	echo pow($x, 2);
	```
		
	</div></details>
	
	<br>