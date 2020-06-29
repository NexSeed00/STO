let text1 = document.getElementById('text1');
text1.textContent = 'ABCD';

let text2 = document.getElementById('text2');
text2.style.color = 'blue';

let text3 = document.getElementsByClassName('text3');

for (let i = 0; i < text3.length; i++) {
  text3.item(i).style.backgroundColor = 'pink';
}

let aList = document.getElementsByTagName('a');
aList.item(0).href = 'https://www.google.com';

let liList = document.getElementsByTagName('li');

for (let i = 0; i < liList.length; i++) {
  liList.item(i).style.fontSize = '30px';
}
