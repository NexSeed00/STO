# 繰り返し

21. 「hoge」という文字を10回出力するプログラムを作成してください。

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 10; i++) {
	    console.log("hoge");
	}
	```
		
	</div></details>
	

	<br>
	
22. 1から10までの数字を出力するプログラムを作成してください。

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 10; i++) {
	    console.log(i);
	}
	```
		
	</div></details>
	

	<br>
	
23. 九九、二の段を表示するプログラムを作成してください。

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 9; i++) {
	    console.log(2 * i);
	}
	```
		
	</div></details>
	

	<br>
	
24. 1から100までの偶数を出力するプログラムを作成してください。

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 100; i++) {
		if (i % 2 == 0) {
	        console.log(i);
		}
	}
	```
		
	</div></details>
	

	<br>

25. 1から100までの数字を出力するプログラムを作成してください。  
ただし、数値が奇数の場合は「奇数です」と出力してください。

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 100; i++) {
		if (i % 2 == 0) {
	        console.log(i);
	    } else {
	        console.log("奇数です");
	    }
	}
	```
		
	</div></details>
	

	<br>
	
26. 1から100までの3の倍数を出力するプログラムを作成してください。  

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 100; i++) {
	    if (i % 3 == 0) {
	        console.log(i);
	    }
	}
	```
		
	</div></details>
	

	<br>
	
27. 1から100までの5の倍数を出力するプログラムを作成してください。  

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 100; i++) {
	    if (i % 5 == 0) {
	        console.log(i);
	    }
	}
	```
		
	</div></details>
	

	<br>
	
28. 1から100までの3の倍数かつ5の倍数を出力するプログラムを作成してください。  

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 100; i++) {
	    if (i % 3 == 0 && i % 5 == 0) {
	        console.log(i);
	    }
	}
	```
		
	</div></details>
	

	<br>
	
29. 1から100までの数字を出力するプログラムを作成してください。  
ただし、3の倍数の場合は数の代わりに｢Fizz｣と出力してください。

	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 100; i++) {
	    if (i % 3 == 0) {
	        console.log("Fizz");
	    } else {
	        console.log(i);
	    }
	}
	```
		
	</div></details>
	

	<br>
	
30. 1から100までの数字を出力するプログラムを作成してください。  
ただし、3の倍数の場合は数の代わりに｢Fizz｣、5の倍数のときは｢Buzz｣、3と5両方の倍数の場合には｢FizzBuzz｣と出力してください。
	<details><summary>回答例</summary><div>
		
	```
	for (let i = 1; i <= 100; i++) {
	    if (i % 3 == 0 && i % 5 == 0) {
	        console.log("FizzBuzz");
	    } else if (i % 3 == 0) {
	        console.log("Fizz");
	    } else if (i % 5 == 0) {
	        console.log("Buzz");
	    } else {
	        console.log(i);
	    }
	}
	```
		
	</div></details>
	

	<br>
	