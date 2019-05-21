<?php
require_once 'phpQuery.php';

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

  static function get_data_item($title){ // Функция парсера dota вещей по названию
    $url='https://steamcommunity.com/market/listings/570/'.str_replace(' ', '%20', $title);
    $html=self::get_html($url); // Вызываем функцию get_html() и HTML помещаем в переменную $html
    $doc=phpQuery::newDocument($html); // С помощью библиотеки phpQuery создаем объект из HTML
    $name=$doc->find('.market_listing_item_name:eq(0)')->html(); // Поиск элемента 'Имя'
    $val=$doc->find('#searchResults_total')->html(); // Поиск элемента 'Количество'
    $val=str_replace(',', '', $val); // Удаляет запятые в строке
    $res=['name'=>$name, 'val'=>$val];
    return $res;
  }

  static function get_data($title){ // УСТАРЕВШАЯ Функция парсера steam !не работает!
    $url='https://steamcommunity.com/market/listings/570/'.str_replace(' ', '%20', $title);
    $html=self::get_html($url); // Вызываем функцию get_html() и HTML помещаем в переменную $html
    $doc=phpQuery::newDocument($html); // С помощью библиотеки phpQuery создаем объект из HTML
    foreach($doc->find('#searchResultsRows .market_recent_listing_row') as $el){ // Цикл поиска элементов
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
?>
