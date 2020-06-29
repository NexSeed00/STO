<?php

    function talk($name){
        echo 'こんにちは、ボクの名前は' . $name . 'です<br>';
    }


    function eat($food){
        echo '好きな食べ物は' . $food . 'です<br>';
    }

    function greeting(){
        talk('ドラえもん');
        eat('どら焼き');
    }  


    greeting();