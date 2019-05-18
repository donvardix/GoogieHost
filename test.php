<?php

require_once 'Controllers/Parser.php';
require_once 'Controllers/Db.php';


$arr=Parser::get_data_item('Bracers of the Cavern Luminar');
echo $arr['name'].' - '.$arr['val'];


 ?>
