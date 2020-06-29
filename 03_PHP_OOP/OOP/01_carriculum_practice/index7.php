<?php
//  設計書 
class Robot{

  //値 
  public $name;
  public $food;

  
  // <!-- 技一覧 -->
  // <!-- // talkメソッド追加 -->
  private function talk(){
    echo 'こんにちは、ボクの名前は' . $this->name . 'です<br>';
  }

  // <!-- // eatメソッド追加 -->
  private function eat(){
    echo '好きな食べ物は' . $this->food . 'です<br>';
  }

  // <!-- // greetingメソッド追加 -->
  // <!-- thisはクラスのこと -->
  public function greeting(){
    $this->talk();
    $this->eat();
  }
  
  // 値をセットする技一覧
  // nameプロパティに値を設定するメソッド
  public function setName($namae){
    $this->name = $namae;
  }

  // foodプロパティに値を設定するメソッド
  public function setFood($tabemono){
  	$this->food = $tabemono;
  }

}

// ものづくり 
$robot = new Robot();
$robot->setName('ドラえもん');
$robot->setFood('どら焼き');
$robot->greeting();

// 練習問題7
// エラーがでないように各メソッドをprivateとpublicに指定