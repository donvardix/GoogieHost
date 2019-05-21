<?php

require_once 'Controllers/Db.php';
echo Db::ToJson($_GET['id']);

?>
