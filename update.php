<?php

require_once 'Controllers/Parser.php';
require_once 'Controllers/Db.php';

$query=$pdo->query('SELECT item, item_under FROM list_items')->fetchAll(PDO::FETCH_OBJ);
foreach ($query as $name) {
  $arr = Parser::get_data_item($name->item);
  Db::send($arr, $name->item_under);
}


?>
