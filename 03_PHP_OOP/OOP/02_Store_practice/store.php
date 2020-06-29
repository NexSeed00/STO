<?php

//  設計書
    class Store {

        public $name;
        
        public function sell($item) {
          echo $this->name. 'で' . $item . 'を売りました';
        }

        public function __construct($shop){
          $this->name = $shop;
        }
    }

  //インスタンスを作成

  $store = new Store('コーナン');
  $store->sell('工具');
