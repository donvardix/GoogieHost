<?php

require_once 'lib/phpQuery.php';


class MyFuncs
{
  function get_content($url){
    $init=curl_init($url);
    curl_setopt($init, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
    $html=curl_exec($init);
    curl_close($init);
    return $html;
  }

  function parser_f($url, $find){
    $html=MyFuncs::get_content($url);
    $doc=phpQuery::newDocument($html);
    foreach($doc->find($find) as $article){
      $article=pq($article);
      $name=$article->find('.market_listing_item_name')->html();
      $val=$article->find('.market_listing_num_listings_qty')->html();
      //print_r($name);
      echo "$name - $val.<br>";
    }
  }

  function parser($url, $find){
    $html=MyFuncs::get_content($url);
    $doc=phpQuery::newDocument($html);
    $res=$doc->find($find);
    return $res;
  }
}

?>
