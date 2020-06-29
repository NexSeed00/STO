# 関数

51. 以下の関数を作成して、作成した関数を実行してください。

	関数名：printHoge  
	処理内容：「Hoge」と出力する

	<details><summary>回答例</summary><div>
		
	```
	function printHoge() {
	    console.log("Hoge");
	}
	
	printHoge();

	```
		
	</div></details>
	

	<br>
	
52. 以下の関数を作成して、作成した関数を実行してください。

	関数名：printNum  
	引数：1つの数値  
	処理内容：引数で受け取った数値を出力する

	<details><summary>回答例</summary><div>
		
	```
	function printNum(num) {
	    console.log(num);
	}
	
	printNum(4);
	```
		
	</div></details>
	

	<br>
	
53. 以下の関数を作成して、作成した関数を実行してください。

	関数名：printKuku  
	引数：1つの数値  
	処理内容：引数で受け取った数値の九九（1から9までかけた数）を出力する

	<details><summary>回答例</summary><div>
		
	```
	function printKuku(num) {
	    for (var i = 1; i <= 9; i++) {
	        console.log(num * i)
	    }
	}
	
	printKuku(4);
	```
		
	</div></details>
	

	<br>
	
54. 以下の関数を作成して、作成した関数を実行してください。

	関数名：printIsEven  
	引数：1つの数値  
	処理内容：引数で受け取った数値が偶数の場合は「偶数です」と出力し、奇数の場合は「奇数です」と出力する

	<details><summary>回答例</summary><div>
		
	```
	function printIsEven(num) {
	    if (num % 2 == 0) {
	        console.log("偶数です");
	    } else {
	        console.log("奇数です");
	    }
	}
	
	printIsEven(3);
	```
		
	</div></details>
	

	<br>
	
55. 以下の関数を作成して、作成した関数を実行してください。

	関数名：printMessage  
	引数1：1つの文字列  
	引数2：1つの数字  
	処理内容：引数で受け取った文字列を、引数で受け取った数値分繰り返し出力する
	
	例
	
	```
	printMessage("ABC", 3);
	
	// 実行結果
	ABC
	ABC
	ABC
	```

	<details><summary>回答例</summary><div>
		
	```
	function printMessage(str, count) {
	    for (var i = 0; i < count; i++) {
	        console.log(str);
	    }
	}
	
	printMessage("ABC", 3);
	```
		
	</div></details>
	

	<br>
	
56. 以下の関数を作成して、作成した関数を実行してください。

	関数名：printMaxNum  
	引数1：1つの数値  
	引数2：1つの数値  
	処理内容：引数で受け取った2つの数値のうち、最も大きな数値を出力する。
	
	<details><summary>回答例</summary><div>
		
	```
	function printMaxNum(num1, num2) {
	    if (num1 > num2) {
	        console.log(num1);
	    } else if (num1 < num2) {
	        console.log(num2);
	    } else {
					console.log("同じ");
			}
	}
	
	printMaxNum(1, 5);
	```
		
	</div></details>
	

	<br>
	
57. 以下の関数を作成して、作成した関数を実行してください。

	関数名：getSquared  
	引数1：1つの数値  
	処理内容：引数で受け取った数値の2乗を計算し返す
	
	例
	
	```
	var result = getSquared(4);
	console.log(result);
	
	// 実行結果
	16
	```
	
	<details><summary>回答例</summary><div>
		
	```
	function getSquared(num) {
	    return num * num
	}
	
	var result = getSquared(4);
	console.log(result);
	```
		
	</div></details>
	

	<br>
	
58. 以下の関数を作成して、作成した関数を実行してください。

	関数名：createSelfIntroductionText  
	引数1：1つの文字列  
	処理内容：「私の名前は○○です」という文字の〇〇を引数で受け取った文字列にし返す
	
	例
	
	```
	var message = createSelfIntroductionText("NexSeed");
	console.log(message);
	
	// 実行結果
	私の名前はNexSeedです
	```
	
	<details><summary>回答例</summary><div>
		
	```
	function createSelfIntroductionText(name) {
	    var msg = "私の名前は" + name + "です";
	    return msg;
	}
	
	var message = createSelfIntroductionText("NexSeed");
	console.log(message);
	```
		
	</div></details>
	

	<br>
	
59. 以下の関数を作成して、作成した関数を実行してください。

	関数名：isEvenNumber  
	引数1：1つの数値  
	処理内容：引数で渡された値が偶数の場合は true、そうでない場合は false を返す。
	
	例
	
	```
	var result = isEvenNumber(3);
	console.log(result);
	
	// 実行結果
	false
	```
	
	<details><summary>回答例</summary><div>
		
	```
	function isEvenNumber(num) {
	    if (num % 2 == 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	var result = isEvenNumber(3);
	console.log(result);
	```
		
	</div></details>
	

	<br>
	
60. 以下の関数を作成して、作成した関数を実行してください。

	関数名：isSeedKun  
	引数1：任意の文字列  
	処理内容：引数で渡された文字列が「SeedKun」の場合は true、そうでない場合は false を返す。
	
	<details><summary>回答例</summary><div>
		
	```
	function isSeedKun(str) {
	    if (str == "SeedKun") {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	var result = isSeedKun("SeedKun");
	console.log(result);
	```
		
	</div></details>
	

	<br>