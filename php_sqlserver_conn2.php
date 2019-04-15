<FORM NAME ="form1" METHOD ="post" ACTION = "">
<br> <b> Enter your query for chart </b> <br> <br><textarea name="servername" rows="1" cols="100"> myclouddbserver.database.windows.net </textarea> <br>
<br> Database : <INPUT TYPE = "Text" NAME = "dbs" value ="myclouddb" > <br>
<br> Uid : <INPUT TYPE = "Text" NAME = "uid" value ="gbatta" > <br>
<br> Pass : <INPUT TYPE = "Text" NAME = "passwd" value ="Deveshi11$" > <br>
<br> <b> Enter your query  </b> <br> <br><textarea name="tarea" rows="3" cols="100"> SELECT TOP 20 FirstName, LastName from SalesLT.Customer </textarea> <br>
<INPUT TYPE = "Submit" Name = "Submit" VALUE = "Go"> <br>
<?php
$strserver = $_POST["servername"];
$strdb = $_POST["dbs"];
$strusr = $_POST["uid"];
$strpass = $_POST["passwd"];
$strQuery = $_POST["tarea"];

$serverName = $strserver ;
$connectionOptions = array(
    "Database" => $strdb,
    "Uid" => $strusr,
    "PWD" => $strpass
);
//Establishes the connection
$conn = sqlsrv_connect($strserver, $connectionOptions);
$tsql= "SELECT TOP 20 FirstName, LastName from SalesLT.Customer";
$getResults= sqlsrv_query($conn, $strQuery);
echo $strserver ;
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