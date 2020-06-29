// Q1
let text1 = document.getElementById('text1');
text1.addEventListener('click', function() {
  this.style.backgroundColor = 'cyan';
});

// Q2
let text2 = document.getElementById('text2');
text2.addEventListener('mouseover', function() {
  this.style.backgroundColor = 'cyan';
});

// Q3
let text3 = document.getElementById('text3');

text3.addEventListener('mouseover', function() {
  this.style.backgroundColor = 'cyan';
});

text3.addEventListener('mouseleave', function() {
  this.style.backgroundColor = 'white';
})

//Q4
let checkButton1 = document.getElementById('check1');
checkButton1.addEventListener('click', function() {
  
  let username = document.getElementsByName('username1')[0];

  let usernameTextView = document.getElementById('usernameTextView1');

  usernameTextView.textContent = username.value;
})

// Q5
let checkButton2 = document.getElementById('check2');

checkButton2.addEventListener('click', function() {
  
  let username = document.getElementsByName('username')[0];
  let age = document.getElementsByName('age')[0];
  
  if (username.value == '') {
    let usernameError = document.getElementById('usernameError');
    usernameError.textContent = 'ユーザー名が空です';
  } else {
    let usernameTextView = document.getElementById('username');
    usernameTextView.textContent = username.value;
  }

  if (age.value < 20) {
    let ageError = document.getElementById('ageError');
    ageError.textContent = '20歳未満です';
  } else {
    let ageTextView = document.getElementById('age');
    ageTextView.textContent = age.value;
  }
})