<?php
$pdo=new PDO('mysql:host=localhost;dbname=lari', 'root', 'fghtkm96');
$query=$pdo->query('SELECT date, value FROM steam_price')->fetchAll(PDO::FETCH_OBJ);
$all=[];

foreach ($query as $q) {
	$all[]=[(strtotime($q->date)+10800)*1000, (int)$q->value];
}
echo json_encode($all);


?>
