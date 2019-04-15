
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
	 
       var dataq = google.visualization.arrayToDataTable([
        ['Genre', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western', 'Literature', { role: 'annotation' } ],
        ['2010', 10, 24, 20, 32, 18, 5, ''],
        ['2020', 16, 22, 23, 30, 16, 9, ''],
        ['2030', 28, 19, 29, 30, 12, 13, '']
      ]);	 
 var data = google.visualization.arrayToDataTable([
 
 ['class Name','Students'],
<?php 
$serverName = "myclouddbserver.database.windows.net" ;
$connectionOptions = array(
    "Database" => "myclouddb",
    "Uid" => "gbatta",
    "PWD" => "mypwd1234$"
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
          legend: 'right', 'width' :800, 'height' :300
 };
 var op1 = {
 title: 'This is example of bar chart',
  pieHole: 0.5,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none', 'width' :800, 'height' :300
 };
  var op2 = {
 title: 'Line Chart showing spike',
  pieHole: 0.5,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none', 'width' :800, 'height' :300
 };
var optionq = {
	    width: 800,
        height: 300,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };
 var chart = new google.visualization.PieChart(document.getElementById("chart_div"));
 chart.draw(data,options);
 var chart1 = new google.visualization.LineChart(document.getElementById("columnchart12"));
 chart1.draw(data,op2);
 var chart2 = new google.visualization.BarChart(document.getElementById("barchart12"));
 chart2.draw(data,op1);
 var chart3 = new google.visualization.BarChart(document.getElementById("barchartstack"));
 chart3.draw(dataq,optionq);
 
 }
 



	
    </script>
<style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */
	

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
	}
</style> 
</head>

<body>
<h1 align="center", style="background-color:Tomato;">MSSQL PHP Dashboards using Google Charts</h1>
<br><br>
 <div class="row" >
 <div id="columnchart12" class="column" style="width: 50%; height: 500px"></div>
  <div id="chart_div" class="column" style="width: 50%; height: 500px"></div>
 </div>
 <div class="row" >
     <div id="barchart12" class="column" style="width: 50%; height: 500px"></div>
	      <div id="barchartstack" class="column" style="width: 50%; height: 500px"></div>
 </div>
</body>
</html>

