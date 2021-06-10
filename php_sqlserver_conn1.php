
<FORM NAME ="form1" METHOD ="post" ACTION = "">
<br> <b> Enter your query for chart </b> <br> <br><textarea name="tarea" rows="3" cols="100"> select sample_date as c1, cpu_util as  v1, memory_util as v2 from charting </textarea> <br>
<INPUT TYPE = "Submit" Name = "Submit" VALUE = "Go"> <br>
<?php
/* Include the `fusioncharts.php` file that contains functions	to embed the charts. */

   include("fusioncharts.php");
   

$serverName = "myclouddbserver.database.windows.net" ;
$connectionOptions = array(
    "Database" => "myclouddb",
    "Uid" => "gbatta",
    "PWD" => "MyUsuall1$"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
$strQuery = $_POST["tarea"];
$tsql= "select sample_date as c1, cpu_util as  v1, memory_util as v2 from charting";
$results= sqlsrv_query($conn, $tsql);

 while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
 echo ($row['c1'] . " " . $row['v1'] . " " . $row['v2'] . PHP_EOL);
}

sqlsrv_free_stmt($results);
?>
