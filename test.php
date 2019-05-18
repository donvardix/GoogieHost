<?php

require_once 'Controllers/Parser.php';


$arr=Parser::get_data_item('https://steamcommunity.com/market/listings/570/Bracers%20of%20the%20Cavern%20Luminar');
echo $arr['name'];
echo '<hr>';
echo $arr['val'];
echo '<hr>';
echo str_replace(' ', '_', 'Bracers of the Cavern Luminar');;


 ?>
