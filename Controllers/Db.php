<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
date_default_timezone_set('Europe/Kiev'); // Установка часового пояса для сервера

class Db
{
  static function send($arr, $dbname){ // Функция отправки данных в БД
    global $pdo;
    $dbname=str_replace(' ', '_', mb_strtolower($dbname));
    $sql='INSERT INTO '.$dbname.'(date, val) VALUES(?, ?)';
    $query=$pdo->prepare($sql);
    $query->execute([date('Y-m-d H:i:s'), $arr['val']]);
  }

  static function get_name_item(){ // Функция для получения всех предметов из БД
    global $pdo;
    $query=$pdo->query('SELECT item FROM list_items')->fetchAll(PDO::FETCH_OBJ);
    foreach ($query as $el) {
      echo '<a href="/?id='.str_replace(' ', '_', mb_strtolower($el->item)).'">'.$el->item.'</a><br>';
    }
  }

  static function get($dbname){ // Функция для получения данных из БД
    global $pdo;
    $dbname=str_replace(' ', '_', mb_strtolower($dbname));
    $query=$pdo->query('SELECT date, val FROM '.$dbname)->fetchAll(PDO::FETCH_OBJ);
    echo '<h1>'.$dbname.'</h1>';
    foreach ($query as $el) {
      echo "$el->date || $el->val<hr>";
    }
  }

  static function create_table($name){ // Функция создания таблицы
    global $pdo;
    //$name=str_replace(' ', '_', mb_strtolower($name));
    $sql='CREATE TABLE '.$name.'(id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, date TIMESTAMP, val INT( 255 ))';
    $pdo->exec($sql);
  }

  static function ToJson($dbname){ // Функция преобразования массива из БД в json формат
    global $pdo;
    $dbname=str_replace(' ', '_', mb_strtolower($dbname));
    $query=$pdo->query('SELECT date, val FROM '.$dbname)->fetchAll(PDO::FETCH_OBJ);
    $arr=[];
    foreach ($query as $el) {
    	$arr[]=[(strtotime($el->date)+10800)*1000, (int)$el->val];
    }
    return json_encode($arr);
  }

  static function add_item($item){ // Функция добавление нового предмета для слежения
    global $pdo;
    $item_low=str_replace(' ', '_', mb_strtolower($item));
    $res = $pdo->query('SHOW TABLES LIKE "'.$item_low.'"');
    if($res->rowCount()!=1){
      self::create_table($item_low);
      $sql='INSERT INTO list_items(item) VALUES(?)';
      $query=$pdo->prepare($sql);
      $query->execute([$item]);
      self::get_name_item();

    }else{
      echo 'Предмет уже существует в базе данных<br>';
      self::get_name_item();
    }
  }



}
?>
