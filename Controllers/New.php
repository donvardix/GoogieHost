<?php

class New
{
  // (ТОЛЬКО LARAVEL) используется Carbon use Carbon\Carbon;
  // Количесво продаж предмета на ТП Steam по заданной дате
  public static function curl(){
    $url="https://steamcommunity.com/market/listings/570/Grasping%20Bludgeon";
    $init=curl_init($url); // Инициализирует сеанс cURL
    curl_setopt($init, CURLOPT_FOLLOWLOCATION, true); // Разрешает редирект по сайту
    curl_setopt($init, CURLOPT_RETURNTRANSFER, true); // Возврат результата в качестве строки
    $html=curl_exec($init); // Помещаем HTML в переменную
    curl_close($init);  // Закрываем сеанс

    // Парсим данные с графика steam
    $start = 'var line1=';
    $end = ']];';
    $delete_before=substr($html, strpos($html, $start)+strlen($start));
    $data=substr($delete_before, 0, strpos($delete_before, $end)+strlen($end)-1);

    // Полученную строку преобразуем в массив и получим из него последние 24 записи
    $array=json_decode($data);
    $res=array_slice($array, -24);


    // Находим сумму чиссел массива по заданной дате
    $find_date='02.06.2019';
    $sum=0;
    foreach($array as $r){
      $date=$r[0];
      $date_carbon=Carbon::createFromDate(substr($date, 0, strpos($date, ":")+1).'00 +0')->setTimezone('Europe/Kiev');
      if($date_carbon->format('d.m.Y')==$find_date){
        $sum+=$r[2];
      }

    }
    echo $sum;

  }
}


?>
