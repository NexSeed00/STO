<?php
   function shopping($wallet, $change) {
	   return $wallet - $change;
   }

   echo shopping(1000, 300);


   function shopping2($item1, $item2){
     return $item1 * $item2; 
   }

   echo shopping(2000,300) * shopping2(20, 20);
?>