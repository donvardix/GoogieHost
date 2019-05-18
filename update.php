<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/Parser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/Db.php';

$arr = Parser::get_data_item('Bracers of the Cavern Luminar');
Db::send($arr);

?>
