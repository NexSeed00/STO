# 配列

31. 定数arrayを作成し、1から10の数値を保持する配列を代入してください。

	<details><summary>回答例</summary><div>
		
	```
	const array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	```
		
	</div></details>
	

	<br>
	
32. 定数arrayを作成し、アルファベットA〜Eの文字列を保持する配列を代入してください。

	<details><summary>回答例</summary><div>
		
	```
	const array = ['A', 'B', 'C', 'D', 'E'];
	```
		
	</div></details>
	

	<br>
	
33. 以下の表にあう配列を作成してください。   
	
 | 配列名  | 値               |
 | ------- | ---------------- |
 | animals | dog, fox, monkey |

  <details><summary>回答例</summary><div>
		
	```
	const animals = ['dog', 'fox', 'monkey'];
	```
		
  </div></details>
	<br>
	
34. 33で作成した配列animalsに「elephant」を追加してください。  

	<details><summary>回答例</summary><div>
		
	```
	animals.push('elephant');
	```
		
	</div></details>
	

	<br>
	
35. 33で作成した配列animals内の「dog」を「cat」に更新してください。  

	<details><summary>回答例</summary><div>
		
	```
	animals[0] = 'cat';
	```
		
	</div></details>
	

	<br>
	
36. 33で作成した配列animals内の「fox」を削除してください。  

	<details><summary>回答例</summary><div>
		
	```
	animals.splice(1, 1);
	```
		
	</div></details>
	

	<br>
	
37. 33で作成した配列animalsの中身を全て出力してください。  

	<details><summary>回答例</summary><div>
		
	```
	for (animal of animals) {
	    console.log(animal);
	}
	```
		
	</div></details>
	

	<br>
	
38. 33で作成した配列animalsの中身を全て出力してください。  
ただし、「fox」は出力しないでください。  

	<details><summary>回答例</summary><div>
		
	```
	for (animal of animals) {
	    if (animal != 'fox') {
	        console.log(animal);
	    }
	}
	```
		
	</div></details>
	

	<br>

39. 自分で好きな配列を作成してください。

40. 39で作成した配列の中身を全て出力してください。