<?php

require_once 'config.php';
date_default_timezone_set('Europe/Kiev'); // Установка часового пояса для сервера

class Db
{
  public static function send($val, $dbname){ // Функция отправки данных в БД
    global $pdo;
    $sql="INSERT INTO `".$dbname."`(date, val) VALUES(?, ?)";
    $query=$pdo->prepare($sql);
    $query->execute([date('Y-m-d H:i:s'), $val]);
  }

  public static function get_name_item(){ // Функция для получения всех предметов из БД
    global $pdo;
    $query=$pdo->query('SELECT item, item_under FROM list_items')->fetchAll(PDO::FETCH_OBJ);
    return $query;
  }

  public static function create_table($name){ // Функция создания таблицы
    global $pdo;
    $sql="CREATE TABLE `".$name."`(id INT( 11 ) AUTO_INCREMENT PRIMARY KEY, date TIMESTAMP, val INT( 255 ))";
    $pdo->exec($sql);
  }

  public static function ToJson($dbname){ // Функция преобразования массива из БД в json формат
    global $pdo;
    $query=$pdo->query("SELECT date, val FROM `".$dbname."`")->fetchAll(PDO::FETCH_OBJ);
    $arr=[];
    foreach ($query as $el) {
    	$arr[]=[(strtotime($el->date)+10800)*1000, (int)$el->val];
    }
    return json_encode($arr);
  }

  public static function add_item($item){ // Функция добавление нового предмета для слежения
    global $pdo;
    $item_low=str_replace(' ', '_', str_replace("'", '', mb_strtolower($item)));
    $res = $pdo->query('SHOW TABLES LIKE "'.$item_low.'"');
    if($res->rowCount()!=1){
      self::create_table($item_low);
      $sql='INSERT INTO list_items(item, item_under) VALUES(?, ?)';
      $query=$pdo->prepare($sql);
      $query->execute([$item, $item_low]);
    }else{
      echo '<p class="text-danger">Предмет уже существует в базе данных</p><hr>';
    }
  }

  public static function item_underTOitem($item_under){ // Функция поиска полного название предмета по сокращенному
    global $pdo;
    $sql='SELECT item, item_under FROM list_items WHERE item_under = ?';
    $query=$pdo->prepare($sql);
    $query->execute([$item_under]);
    return $query->fetchColumn();
  }


  public static function delete_item($item_id){ // Функция поиска полного название предмета по сокращенному
    $sql = "DELETE FROM list_items WHERE id =  :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $item_id);
    $stmt->execute();
  }

}
?>
