<FORM NAME ="form1" METHOD ="post" ACTION = "">
<br> <b> Enter your query for chart </b> <br> <br><textarea name="tarea" rows="3" cols="100"> select top 10 sample_date , cpu_util  from charting </textarea> <br>
<INPUT TYPE = "Submit" Name = "Submit" VALUE = "Go"> <br>
<?php
$strQuery = $_POST["tarea"];

$serverName = "myclouddbserver.database.windows.net" ;
$connectionOptions = array(
    "Database" => "myclouddb",
    "Uid" => "gbatta",
    "PWD" => "Deveshi11$"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
$tsql= "SELECT TOP 20 FirstName, LastName from SalesLT.Customer";
$getResults= sqlsrv_query($conn, $strQuery);
echo ("Reading data from table" . PHP_EOL);
if ($getResults == FALSE)
    echo (sqlsrv_errors());
echo "<table border='1'>";
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
{
echo '<tr>';
foreach($row as $key=>$value)
{
echo '<td>',$value,'</td>';
}
echo '</tr>';
}
echo '</table><br />';
sqlsrv_free_stmt($getResults);
?>