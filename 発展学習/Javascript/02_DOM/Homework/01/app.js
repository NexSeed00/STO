// Q1
let text1 = document.getElementById('text1');
text1.textContent = 'ABC';

//Q2
let text2 = document.getElementById('text2');
text2.style.color = 'blue';

// Q3
let text3 = document.getElementsByClassName('text3');
for (let i = 0; i < text3.length; i++) {
  text3.item(i).style.backgroundColor = 'pink';
}

// Q4
let aList = document.getElementsByTagName('a');
aList.item(0).href = 'https://www.google.com';

// Q5
let liList = document.getElementsByTagName('li');
for (let i = 0; i < liList.length; i++) {
  liList.item(i).style.fontSize = '30px';
}