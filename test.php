<?php

require_once 'Controllers/Parser.php';
require_once 'Controllers/Db.php';

$title='bracers_of_the_cavern_luminar';
$title=str_replace('_', ' ', $title);
$url='https://steamcommunity.com/market/listings/570/'.str_replace(' ', '%20', ucwords($title));
echo $url;


 ?>
