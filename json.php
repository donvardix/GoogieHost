<?php
require_once 'pdo/db.php';

$query=$pdo->query('SELECT date, val FROM bracers_of_the_cavern_luminar')->fetchAll(PDO::FETCH_OBJ);
$all=[];

foreach ($query as $el) {
	$all[]=[(strtotime($el->date)+10800)*1000, (int)$el->val];
}
echo json_encode($all);


?>
