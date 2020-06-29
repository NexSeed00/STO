/**
 * classの追加 addClass()
 * classの削除 removeClass()
 * タグの追加 $('<div>')
 * 要素の取得
 *  - $('div')
 *  - $('.className')
 *  - $('#idName')
 */

$(function() {
  // Q1
  $("#q1-btn").on("click", function() {
    $(this).addClass("large-btn");
  });

  // Q2
  $('#q2-btn').on('mouseover', function() {
    $(this).css('opacity', 0.5);
  })

  // Q3
  $('#q3-btn')
    .on('mouseover', function() {
      $(this).css('opacity', 0.5);
    })
    .on('mouseleave', function() {
      $(this).css('opacity', 1);
    });

  // Q4
  $('#q4-btn').on('click', function () {
    $('#q4-text').text('これに変更');
  });

  // Q5
  $('#q5-btn').on('click', function () {
    // 例①
    let li = $('<li>');
    li.text('ぶどう');
    li.addClass('grape');
    $('.apple').before(li);

    // 例②
    // $('.apple').before('<li class="grape">ぶどう</li>');
  });

  // Q6
  $('#q6-btn').on('click', function () {
    let span = $('<span>');
    span.text('追加');
    span.addClass('red');

    $('.q6-text').append(span);
  });

  // Q7
  $('#q7-btn').on('click', function () {
    $(this).toggleClass('on');
  });

  // Q8
  $('#q8-btn').on('click', function () {
    $(this)
      .siblings()
      .slideToggle();
  });

  // Q9
  $('#q9-btn').on('click', function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
  });

  // Q10
  $('.q10-show-btn').on('click', function() {
    $('.q10-target').fadeIn(1000);
  });

  $('.q10-hide-btn').on('click', function() {
    $('.q10-target').fadeOut(2000);
  });

  // Q11
  $(window).on('scroll', function() {
    // idがq-11の要素の画面最上部からの距離を取得
    let q11 = $('#q11').offset().top;

    // 画面の高さ
    let wh = $(window).height();

    // $(window).scrollTop()は現在のスクロール位置
    if (q11 <= $(window).scrollTop() + wh) {
      $('.q11-target').removeClass('hide');
    } else {
      $('.q11-target').addClass('hide');
    }
    
  })

  // Q12
  $('#q12-btn').on('click', function() {
    $('.q12-target').toggleClass('hide');
  })

});
