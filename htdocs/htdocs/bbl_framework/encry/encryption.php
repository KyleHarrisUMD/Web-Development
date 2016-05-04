<?php
     class encryptor
     {
        public function encrypt($password)
         {

             $md_5_encryption = md5($password);
             $reversed =strrev($md_5_encryption);

             $carrot = (strlen($reversed) / 2);

             $sub_str_1 = substr($reversed, 0 , $carrot);
             $sub_str_2  = substr($reversed, $carrot, strlen($reversed));

             $a_thousand_yous_and_one_of_me = hash('ripemd160',"bubbl_creator");

             $scramble = $sub_str_2.$a_thousand_yous_and_one_of_me.$sub_str_1;

             return $scramble;

         }
     }

?>
