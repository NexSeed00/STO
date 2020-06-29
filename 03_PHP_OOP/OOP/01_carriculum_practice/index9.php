<?php
//  設計書 
class Robot{

  //値 
  private $name;
  private $food;

   // コンストラクタで初期値を設定
   function __construct(){
  	$this->name = 'ドラえもん';
  	$this->food = 'どら焼き';
  }
  
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

   // nameプロパティのゲッターメソッド追加
   public function getName(){
    return $this->name;
  }

  // foodプロパティに値を設定するメソッド
  public function setFood($tabemono){
  	$this->food = $tabemono;
  }

   // foodプロパティのゲッターメソッド追加
   public function getFood(){
  	return $this->food;
  }

}

// ものづくり 
$robot = new Robot();

// 初期値を出力
echo '初期値の名前：' . $robot->getName() . '<br>';
echo '初期値の食べ物：' . $robot->getFood() . '<br>';

$robot->setName('ドラ・ザ・キッド');
$robot->setFood('ケチャップとマスタードをかけたドラ焼き');
$robot->greeting();

// コンストラクタ