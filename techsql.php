
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="refresh" content="20" >
 <meta charset="utf-8">
 <title>DBA-Batta</title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([
 
 ['class Name','Students'],
<?php 
$serverName = "myclouddbserver.database.windows.net" ;
$connectionOptions = array(
    "Database" => "myclouddb",
    "Uid" => "gbatta",
    "PWD" => "MyUsual22$$"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
 
$tsql= "SELECT top 10 class_name,students from class";
$getResults= sqlsrv_query($conn, $tsql);
while ( $row = sqlsrv_fetch_array($getResults))
{

echo "['".$row['class_name']."',".$row['students']."],";

}

sqlsrv_free_stmt($getResults);
?> 
 
 ]);
 
 var options = {
 title: 'Number of Students according to their class',
  pieHole: 0.5,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
	
    </script>
 
</head>
<body>
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>
 
</body>
</html>

