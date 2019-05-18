<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
date_default_timezone_set('Europe/Kiev'); // Установка часового пояса для сервера

class Db
{
  static function send($arr){ // Функция отправки данных в БД
    global $pdo;
    $sql='INSERT INTO bracers_of_the_cavern_luminar(date, val, price) VALUES(?, ?, ?)';
    $query=$pdo->prepare($sql);
    $query->execute([date('Y-m-d H:i:s'), $arr['val'], $arr['price']]);
  }

  static function ToJson(){ // Функция преобразования массива из БД в json формат
    global $pdo;
    $query=$pdo->query('SELECT date, val FROM bracers_of_the_cavern_luminar')->fetchAll(PDO::FETCH_OBJ);
    $arr=[];
    foreach ($query as $el) {
    	$arr[]=[strtotime($el->date)*1000, (int)$el->val];
    }
    return json_encode($arr);
  }

  static function get(){ // Функция отправки данных в БД
    global $pdo;
    $query=$pdo->query('SELECT date, val, price FROM bracers_of_the_cavern_luminar')->fetchAll(PDO::FETCH_OBJ);
    echo '<h1>Bracers of the Cavern Luminar</h1>';
    foreach ($query as $el) {
      echo "$el->date || $el->val || $el->price<hr>";
    }
  }
}

?>
