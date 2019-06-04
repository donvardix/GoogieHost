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
    $val=$doc->find('#searchResults_total')->html(); // Поиск элемента 'Количество'
    $val=str_replace(',', '', $val); // Удаляет запятые в строке
    return $val;
  }


}
?>
