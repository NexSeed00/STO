# Unixコマンド一覧


### cd
ディレクトリの移動  
change dictoryの略  


使用例
```
# cd 移動先
# cd ディレクトリ名 => 指定したディレクトリに移動
# cd ~              => ユーザーのホームに移動
# cd /              => ルートディレクトリに移動
# cd ..             => 一個上に移動

# hogeディレクトリに移動
cd hoge
```


### ls
ディレクトリ内のファイル、フォルダの表示  
- -aオプションで隠しファイルも表示
- -lでファイルの権限などの詳細も表示  
 
使用例
```
ls

ls -la 
```


### pwd
現在のディレクトリを表示 
 
使用例
```
pwd
```


### mv
moveの略。
ファイル、ディレクトリの移動に使用
 
使用例
```
# style.cssをcssディレクトリに移動
mv style.css css

# app.jsをmain.jsにリネーム
mv app.js main.js
```


### cp
ファイルのコピー  

使用例
```
cp hoge.txt fuga.txt
```


### mkdir
ディレクトリの作成

使用例
```
mkdir sample
```


### touch
ファイルの作成

使用例
```
touch index.html
```


### rm
ファイルの削除

使用例
```
rm fuga.txt

# -rf オプションを付与でディレクトリを削除
rm -rf test
```


### cat
ファイルの中身を全て表示

使用例
```
cat fuga.txt
```


### less
ファイルの中身を全て表示  
但し、画面に表示できない行はスクロールする。  
qを押すと終了してコマンド待機状態に戻る

使用例
```
less fuga.txt
```


### tail
ファイルの末尾からx行表示

使用例
```
tail -30 fuga.txt
```


### head
ファイルの先頭からx行表示

使用例
```
head -30 fuga.txt
```


### grep
対象のファイルから指定した文字を検索

使用例
```
# fuga.txtから1を検索
grep 1 fuga.txt
```


### history
コマンドの履歴を確認

使用例
```
history

# 直近の100件を表示
history -100

```


### |
コマンドを組み合わせる

使用例
```
# cpを含むコマンドを一覧で表示
history -100 |grep cp

```

### echo
文字を画面に出力する

使用例
```
# 変数 $PATHの内容を表示する
echo $PATH
```

### find
指定したディレクトリ内からファイルを検索

使用例
```
# カレントディレクトリからfuga.txtを検索
find . -name fuga.txt

```

### chmod
指定したファイル(ディレクトリ)のアクセス権を変更

使用例
```
# fuga.txtを全てのユーザーが、読み取り、書き込み、実行できるようにする
chomod 777 fuga.txt
```

この他にもいろいろなコマンドがあります。  
また、紹介したコマンドにも様々なオプションがあります。  
興味があったら調べてみましょう。  
