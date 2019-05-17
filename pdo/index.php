<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDO</title>
  </head>
  <body>
    <?php
      require_once 'db.php';

      $query=$pdo->query('SELECT date, val, price FROM bracers_of_the_cavern_luminar')->fetchAll(PDO::FETCH_OBJ);
      echo '<h1>Bracers of the Cavern Luminar</h1>';
      foreach ($query as $el) {
        echo "$el->date || $el->val || $el->price<hr>";
      }

    ?>
  </body>
</html>
