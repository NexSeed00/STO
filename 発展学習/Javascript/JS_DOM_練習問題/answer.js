// Q1
let text1 = document.getElementById('q1-text');
console.log(text1.textContent);

// Q2
let text2 = document.querySelector('#q2-text');
text2.textContent = "変更しました!!!";

// Q3
let text3 = document.querySelector('#q3-text');
text3.style.color = "red";

// Q4
let texts4 = document.querySelectorAll('.q4-text');
for (text of texts4) {
  text.style.color = 'blue';
}

// Q5
let texts5 = document.querySelectorAll('.q5-text');
for (text of texts5) {
  text.style.backgroundColor = 'blue';
}

// Q6
let text6 = document.querySelector('#q6-text');
text6.addEventListener('click', function () {
  this.style.color = 'green';
})

// Q7
let text7 = document.querySelector('#q7-text');
text7.addEventListener('mouseover', function () {
  this.style.color = 'white';
  this.style.backgroundColor = 'red';
})

// Q8
let text8 = document.querySelector('#q8-text');
text8.addEventListener('mouseover', function () {
  this.style.backgroundColor = 'yellow';
})

text8.addEventListener('mouseleave', function () {
  this.style.backgroundColor = '';
})

// Q9
let btn9 = document.querySelector('#q9-btn');
btn9.addEventListener('click', function () {
  let input9 = document.querySelector('#q9-input');
  let result9 = document.querySelector('#q9-result');

  result9.textContent = input9.value;
})

// Q10
let btn10 = document.querySelector('.q10-btn');
btn10.addEventListener('click', function () {
  let input10 = document.querySelector('#q10-input');
  let result10 = document.querySelector('#q10-result');

  if (input10.value < 20) {
    result10.textContent = '20歳未満の方の利用は禁止です。';
  } else {
    result10.textContent = input10.value;
  }
})

// Q11
let btn11 = document.querySelector('.q11-btn');
btn11.addEventListener('click', function () {
  let inputAge11 = document.querySelector('#q11-input-age');
  let resultAge11 = document.querySelector('#q11-result-age');

  if (inputAge11.value < 20) {
    resultAge11.style.color = 'red';
    resultAge11.textContent = '20歳未満の方の利用は禁止です。';
  } else {
    resultAge11.style.color = '';
    resultAge11.textContent = inputAge11.value;
  }

  let inputname11 = document.querySelector('#q11-input-name');
  let resultname11 = document.querySelector('#q11-result-name');

  if (resultname11.textContent === '') {
    resultname11.style.color = 'red';
    resultname11.textContent = '名前が空欄です';
  } else {
    resultname11.style.color = '';
    resultname11.textContent = inputname11.value;
  }

})

// Q12
let btn12 = document.querySelector('.q12-btn');
btn12.addEventListener('click', function () {
  let p12 = document.createElement('p');
  p12.textContent = this.textContent;

  let result12 = document.querySelector('.q12-result');
  result12.appendChild(p12);
})

// Q13
let btn13 = document.querySelector('.q13-btn');
btn13.addEventListener('click', function () {
  let apple = document.createElement('li');
  apple.textContent = 'リンゴ';

  let fruits = document.getElementById('q13-box');
  fruits.insertBefore(apple, fruits.firstElementChild);
})

// Q14
let btn14 = document.querySelector('.q14-btn');
btn14.addEventListener('click', function () {
  // document.getElementById('chicken').remove();
  let chiken = document.getElementById('chicken');

  chiken.remove();

})

// Q15
let btns15 = document.querySelectorAll('.q15-btn');
for (btn of btns15) {
  btn.addEventListener('click', function () {
    let link = document.createElement('a');
    let q15list = document.querySelector('.q15-link-list');

    // if (this.textContent === 'Google') {
    //   link.href = 'https://google.com';
    //   link.textContent = this.textContent;
    // } else if (this.textContent === 'YouTube') {
    //   link.href = 'https://youtube.com';
    //   link.textContent = this.textContent;
    // } else if (this.textContent === 'Amazon') {
    //   link.href = 'https://amazon.com';
    //   link.textContent = this.textContent;
    // } else {
    //   alert('不正な操作です');
    // }

    switch (this.textContent) {
      case 'Google':
        link.href = 'https://google.com';
        link.textContent = this.textContent;
        break;
      case 'YouTube':
        link.href = 'https://youtube.com';
        link.textContent = this.textContent;
        break;
      case 'Amazon':
        link.href = 'https://amazon.com';
        link.textContent = this.textContent;
        break;

      default:
        alert('不正な操作です');
        break;
    }

    q15list.appendChild(link);

  })
}