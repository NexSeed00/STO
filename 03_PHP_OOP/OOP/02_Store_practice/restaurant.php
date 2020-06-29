<?php
    
    // step1.ファイルの読み込み
    require_once('store.php');

    // stpe2. extendsを使用し継承
    class Restaurant extends Store{

      

    }

    $restaurant = new Restaurant('サイゼリア');
    $restaurant->sell('ミラノ風ドリア');