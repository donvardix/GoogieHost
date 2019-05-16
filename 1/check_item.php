<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	

<?
	//Проверяет сколько вещей у бота из игры Unturned, для сайта: http://robin.winfortune.co/
	include 'f_parser.php';


	if(!isset($_POST['1'])){
		echo Parse('https://steamcommunity.com/id/donvardix/inventory/', '<span class="games_list_tab_number">', '</span>');
	} else echo Parse('https://steamcommunity.com/id/donvardix/inventory/', '<span class="games_list_tab_number">', '</span>');

?>

<form action="" method="POST">
	<input type="submit" name="1" value="Обновить">
</form>
</body>
</html>