<?php

class MyFuncs
{
  function get_content($url){
    $init=curl_init($url);
    curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
    $html=curl_exec($init);
    curl_close($init);
    return $html;
  }

  function test($a){
    echo $a;
  }
}

?>
