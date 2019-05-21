<?php
// Подключение к БД
$db=['host'=>'localhost', 'dbname'=>'lari', 'user'=>'root', 'password'=>'fghtkm96'];
//$db=['host'=>'localhost', 'dbname'=>'parser_steam', 'user'=>'lari', 'password'=>'FGHTKMfghtkm2404'];

$pdo=new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'], $db['user'], $db['password']);

// /home/donvardp/public_html/
// /usr/local/bin/php /home/donvardp/public_html/update.php

?>
