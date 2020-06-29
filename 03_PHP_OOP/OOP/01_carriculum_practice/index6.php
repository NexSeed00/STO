<?php
//  設計書 
class Robot{

  //値 
  private $name;
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
  
  // 値をセットする技一覧
  // nameプロパティに値を設定するメソッド
  function setName($namae){
    $this->name = $namae;
  }

  // foodプロパティに値を設定するメソッド
  function setFood($tabemono){
  	$this->food = $tabemono;
  }

}

// ものづくり 
$robot = new Robot();
$robot->setName('ドラえもん');
$robot->name = 'ドラミ';
$robot->setFood('どら焼き');
$robot->greeting();

// 練習問題6 


















// いまはpublicだから名前が書き換わってしまう(クラス外から)
// そのためprivateにして書き換わらないようにする