<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Highstock Example</title>

		<style type="text/css">

		</style>
	</head>
	<body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="../lib/highstock.js"></script>
<script src="../lib/exporting.js"></script>
<script src="../lib/export-data.js"></script>


<div id="container" style="height: 400px; min-width: 310px"></div>


		<script type="text/javascript">
$.getJSON('http://php.donvardix.pp.ua/pdo/jsonp.php', function (data) {

    // Create the chart
    Highcharts.stockChart('container', {


        rangeSelector: {
            selected: 1
        },

        title: {
            text: 'AAPL Stock Price'
        },

        series: [{
            name: 'AAPL Stock Price',
            data: data,
            marker: {
                enabled: true,
                radius: 3
            },
            shadow: true,
            tooltip: {
                valueDecimals: 2
            }
        }]
    });
});

		</script>
	</body>
</html>
