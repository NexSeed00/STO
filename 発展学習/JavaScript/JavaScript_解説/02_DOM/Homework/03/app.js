// Q1
let checkButton2 = document.getElementById('check2');

checkButton2.addEventListener('click', function() {
  
  let username = document.getElementById('inputUsername');
  let age = document.getElementById('inputAge');
  
  if (username.value == '') {
    let usernameError = document.getElementById('usernameError');
    usernameError.textContent = 'ユーザー名が空です';
  } else {
    let usernameTextView = document.getElementById('username');
    usernameTextView.textContent = username.value;
    usernameError.textContent = '';
  }

  if (age.value < 20) {
    let ageError = document.getElementById('ageError');
    ageError.textContent = '20歳未満です';
  } else {
    let ageTextView = document.getElementById('age');
    ageTextView.textContent = age.value;
    ageError.textContent = '';
  }
})

// Q2
let apple = document.createElement('li');
apple.textContent = 'リンゴ';

let fruits = document.getElementById('fruits');
fruits.insertBefore(apple, fruits.firstChild);