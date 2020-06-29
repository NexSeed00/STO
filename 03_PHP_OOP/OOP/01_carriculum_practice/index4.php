<?php
//  設計書 
class Robot{

  //値 
  public $name;
  public $food;

  // <!-- 技一覧 -->
  // <!-- // talkメソッド追加 -->
  function talk(){
    echo 'こんにちは、ボクの名前は' . $this->name . 'です<br>';
  }

  // <!-- // eatメソッド追加 -->
  function eat(){
    echo '好きな食べ物は' . $this->food . 'です<br>';
  }

  // <!-- // greetingメソッド追加 -->
  // <!-- thisはクラスのこと -->
  function greeting(){
    $this->talk();
    $this->eat();
  }
}

// ものづくり 
$robot = new Robot();
$robot->greeting();

// 練習問題4までの回答