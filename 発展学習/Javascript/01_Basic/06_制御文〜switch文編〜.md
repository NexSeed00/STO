# 制御文〜switch文編〜

## このカリキュラムの目標
1. 〇〇の場合は△、☓☓の場合は□のような条件分岐がプログラムで書けるようになる。

## 導入
条件によって処理を分ける書き方には、if文の他にswith文という書き方があります。  
if文との違いを理解し、switch文も使えるようになりましょう。

### switch文
変数の値が、Aならこの処理、Bならこの処理、Cならこの処理、など色々な値と順次比較して一致する場合毎に処理を記述する場合があります。if文を使うと次のように記述できます。

```
var value = "A"

if (value == "A") {
    // 処理
} else if (value == "B") {
    // 処理
}else if (value == "C") {
    // 処理
}else if (value == "D") {
    // 処理
} else {
    // 処理
}
```

これはこれで間違いではないのですが、このような用途の場合にはswitch文を使うと便利です。 switch文の書式は次の通りです。
#### switch文の書き方

```
switch (式) {
	case 値1:
		式が値1と等しい場合の処理;
		break;
	case 値2:
		式が値2と等しい場合の処理;
		break;
	case 値3:
		式が値3と等しい場合の処理;
		break;
	default:
		式がいずれの値とも等しくない場合の処理;
		break;
}
```

switch文では式の値を評価し、caseの後に記述された値と順次比較していきます。  
もし一致する値があった場合には、その後に記述された処理を順次処理していき、breakに達したら終了します。
if文の場合にはブロックを使ってどこからどこまでの処理を実行するのかが分かるようになっていましたが、switch文ではcase毎にブロックは使用されず、breakに達するまで順次処理を実行していきます。  
defaultの後の処理は、式がcaseの後に記述されたいずれの値にも一致しなかった時に実行される処理を記述します。

例

```
var value = "A"
switch (value) {
    case "A":
        console.log("Aです");
        break;
    case "B":
        console.log("Bです");
        break;
    case "C":
        console.log("Cです");
        break;
    case "D":
        console.log("Dです");
        break;
    default:
        console.log("上記以外です");
        break;
}
```

### 練習問題
以下の変数を用意してください。

|変数名|値|
|---|---|
|num|任意の数値|

以下の条件に合うようにswitch文を作成してください。

|条件|条件に合致する場合、出力する文字|
|---|---|
|1|1です|
|2|2です|
|3|3です|
|4|4です|
|5|5です|
|それ以外の場合|1,2,3,4,5以外です|

<details><summary>回答例</summary><div>

```
switch (num) {
    case 1:
        console.log("1です");
        break;
    case 2:
        console.log("2です");
        break;
    case 3:
        console.log("3です");
        break;
    case 4:
        console.log("4です");
        break;
    case 5:
        console.log("5です");
        break;
    default:
        console.log("1,2,3,4,5以外です");
        break;
}
```
</div></details>