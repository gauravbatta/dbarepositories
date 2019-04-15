<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="180" >
 
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>
Google Visualization API Sample
</title>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {packages: ['corechart']});
</script>
<script type="text/javascript">
 
function drawVisualization() {
// Create and populate the data table.
var data = new google.visualization.DataTable();
data.addColumn('string', 'yyyymmdd');
data.addColumn('number', 'sla_250ms');
data.addColumn('number', 'sla_1000ms');
data.addColumn('number', 'sla_4000ms');
<?php
 
$db_host = 'localhost';
$db_database = 'fusioncharts_phpsample';
$db_user = 'root';
$db_password = '';
$db = mysql_connect($db_host, $db_user, $db_password);
//$dbhandle = new mysqli($db_host, $db_user, $db_password, $db_database);

mysql_select_db($db_database,$db);

$sqlQuery = "select yyyymmdd ,sla_250ms , sla_1000ms , sla_4000ms  from sla_master_list where region='etdo2-EV6' and yyyymmdd >= ( CURDATE() - INTERVAL 180 DAY ) order by 1";
//$sqlResult = $dbhandle->query($sqlQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
$sqlResult = mysql_query($sqlQuery);
//$sqlResult= $dbhandle->query($sqlQuery);

while ($row = mysql_fetch_assoc($sqlResult)) {
 
echo " data.addRow(['{$row['yyyymmdd']}', {v: {$row['sla_250ms']}, f: '€ {$row['sla_250ms']}' }, {v: {$row['sla_1000ms']}, f: '€ {$row['sla_1000ms']}' }, {v: {$row['sla_4000ms']}, f: '€ {$row['sla_4000ms']}' } ]); ";
 
}
 
?>
 
// Create and draw the visualization.
new google.visualization.LineChart(document.getElementById('visualization')).
draw(data, {curveType: "none",
title: "Benchmark SLAs",
titleTextStyle: {color: "orange"},
width: 1600, height: 400,
//vAxis: {maxValue: 10},
vAxis: {minValue: 0},
vAxis: {title: 'Euro'},
vAxis: {baseline: 0},
vAxis: {gridlines: {count: 10}  },
vAxis: {title: "Euro", titleTextStyle: {color: "orange"}},
hAxis: {title: "Day", titleTextStyle: {color: "orange"}},
interpolateNulls: 1
}
);
}
 
google.setOnLoadCallback(drawVisualization);
</script>
</head>
<body style="font-family: Arial;border: 0 none;">
<div id="visualization" style="width: 500px; height: 400px;"></div>
</body>
</html>