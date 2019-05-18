<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
date_default_timezone_set('Europe/Kiev'); // Установка часового пояса для сервера

class Db
{
  static function send($arr){ // Функция отправки данных в БД
    global $pdo;
    $sql='INSERT INTO bracers_of_the_cavern_luminar(date, val) VALUES(?, ?)';
    $query=$pdo->prepare($sql);
    $query->execute([date('Y-m-d H:i:s'), $arr['val']]);
  }

  static function get(){ // Функция для получения данных из БД
    global $pdo;
    $query=$pdo->query('SELECT date, val FROM bracers_of_the_cavern_luminar')->fetchAll(PDO::FETCH_OBJ);
    echo '<h1>Bracers of the Cavern Luminar</h1>';
    foreach ($query as $el) {
      echo "$el->date || $el->val<hr>";
    }
  }

  static function create_table($name){
    global $pdo;
    $name=str_replace(' ', '_', $name);
    $sql='CREATE TABLE '.$name.'(id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, date TIMESTAMP, val INT( 255 ))';
    $pdo->exec($sql);
  }

  static function ToJson(){ // Функция преобразования массива из БД в json формат
    global $pdo;
    $query=$pdo->query('SELECT date, val FROM bracers_of_the_cavern_luminar')->fetchAll(PDO::FETCH_OBJ);
    $arr=[];
    foreach ($query as $el) {
    	$arr[]=[(strtotime($el->date)+10800)*1000, (int)$el->val];
    }
    return json_encode($arr);
  }



}
?>
