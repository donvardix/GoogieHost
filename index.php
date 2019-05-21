<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>График предмета</title>
</head>
<body>
  <?php require_once 'Controllers/Db.php'; ?>
  <div id="container" style="height: 400px; min-width: 310px"></div>
  <div class="container">
    <form class="" action="" method="post">
      <input id="name" class="form-control" type="text" name="name" placeholder="Имя предмета"><br>
      <button id="send" class="btn btn-success" type="button">Отправить</button>
    </form>
    <hr>
    <div id="list"><?php Db::get_name_item(); echo __DIR__; ?></div>
  </div>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="../lib/highstock.js"></script>
  <script src="../lib/exporting.js"></script>
  <script src="../lib/export-data.js"></script>
  <script type="text/javascript">
    $.getJSON('json.php?id=<?php echo $_GET['id']; ?>', function (data) {
      // Create the chart
      Highcharts.stockChart('container', {
          rangeSelector: {
  					buttons: [{
  							type: 'minute',
  							count: 5,
  							text: '5 min'
  					}, {
  							type: 'hour',
  							count: 1,
  							text: '1h'
  					}, {
  							type: 'day',
  							count: 1,
  							text: '1D'
  					}, {
  							type: 'all',
  							count: 1,
  							text: 'All'
  					}],
  					selected: 3,
  					inputEnabled: false
          },

          title: {
              text: 'Bracers of the Cavern Luminar'
          },

          series: [{
              name: 'Количество',
              data: data,
              marker: {
                  enabled: true,
                  radius: 3
              },
              shadow: true,
              tooltip: {
                  valueDecimals: 0
              }
          }]
      });
  });
  </script>
  <script>
  $('#send').on('click', function(){
    var name=$('#name').val().trim();
    $.ajax({
      url: 'add.php',
      type: 'POST',
      cache: false,
      data: {'name':name},
      dataType: 'html',
      success: function(data){
        $('#list').html(data);
      }
    });
  });
  </script>

</body>
</html>
