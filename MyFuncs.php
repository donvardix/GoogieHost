<?php

require_once 'lib/phpQuery.php';
require_once 'pdo/db.php';

date_default_timezone_set('Europe/Kiev');

class Parser
{
  static function get_html($url){ // Функция получение HTML страницы (CURL)
    $init=curl_init($url); // Инициализирует сеанс cURL
    curl_setopt($init, CURLOPT_FOLLOWLOCATION, true); // Разрешает редирект по сайту
    curl_setopt($init, CURLOPT_RETURNTRANSFER, true); // возврат результата в качестве строки
    $html=curl_exec($init); // Помещаем HTML в переменную
    curl_close($init); // Закрываем сеанс
    return $html;
  }

  static function get_data($url, $find){ // Функция парсера steam
    $html=self::get_html($url); // Вызываем функцию get_html() и HTML помещаем в переменную $html
    $doc=phpQuery::newDocument($html); // С помощью библиотеки phpQuery создаем объект из HTML
    foreach($doc->find($find) as $el){ // Цикл поиска элементов
      $el=pq($el); // DOM -> Object phpQuery
      $name=$el->find('.market_listing_item_name')->html(); // Поиск элемента 'Имя'
      if($name=='Bracers of the Cavern Luminar'){ // Проеверка на определенное имя
        $val=$el->find('.market_listing_num_listings_qty')->attr('data-qty'); // Поиск элемента 'Количество'
        $price=$el->find('.normal_price .normal_price')->html(); // Поиск элемента 'Цена'
        break; // Если имя совпало цикл останавливается
      }
    }
    $res=['name'=>$name, 'val'=>$val, 'price'=>$price];
    return $res;
  }
}

class DB
{
  static function send($arr){
    global $pdo;
    $sql='INSERT INTO bracers_of_the_cavern_luminar(date, val, price) VALUES(?, ?, ?)';
    $query=$pdo->prepare($sql);
    $query->execute([date('Y-m-d H:i:s'), $arr['val'], $arr['price']]);
  }
}

?>
