// ボタンの要素取得
const btn = document.querySelector('#btn');

// ボタンをクリックした時の行う機能を記述する
btn.addEventListener('click', function() {
    // input要素の中に入力された文字を取得（inputは2つあるため、idで指定）
    let inputValue = document.querySelector('#input').value;

    // input要素の何か入力されている時にのみ、以下の処理を実行する
    if(inputValue !== '') {
        // <li>の作成
        const newTask = document.createElement('li');
        // <li>にクラスを追加。（あらかじめstyle.cssに記述した、CSSを適用させるため）
        newTask.classList.add('list');
        // 入力された文字を作成した<li>のtextContentに代入
        newTask.textContent = inputValue;
        // ul要素を取得し、その子要素として、上記で作成した<li>を追加する
        const ul = document.querySelector('ul');
        ul.appendChild(newTask);
        // inputの中に入力された文字を消去する
        document.querySelector('#input').value = '';
        
        // Deleteボタンを作成する
        const deleteBtn = document.createElement('div');
        // 作成した<div>のtextContentを'Delete'にする
        deleteBtn.textContent = 'Delete';
        // クラス名'delete'を追加
        deleteBtn.classList.add('delete');
        // newTaskの子要素として、deleteBtnを追加
        newTask.appendChild(deleteBtn)
        // Deleteボタンをクリックした時に行われる処理を記述
        deleteBtn.addEventListener('click', function() {
            this.parentElement.remove();
        });       
    }
})
