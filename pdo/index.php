<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDO</title>
  </head>
  <body>
    <?php
      require_once 'db.php';
      //echo strtotime('2011-10-14 15:58:00');
      //exit();

      //$pdo->query("SELECT COUNT(*) FROM nametable")->fetchColumn();

      $query=$pdo->query('SELECT date, value FROM steam_price')->fetchAll(PDO::FETCH_OBJ);
      var_dump($query);
      echo '<hr>';
      //echo json_encode($query);
      foreach ($query as $price) {
        echo "$price->value || $price->date<hr>";
      }

    ?>
  </body>
</html>
