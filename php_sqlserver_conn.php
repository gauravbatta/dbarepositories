<?php
$serverName = "myclouddbserver.database.windows.net";
$connectionOptions = array(
    "Database" => "myclouddb",
    "Uid" => "gbatta",
    "PWD" => "Deveshi11$"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
$tsql= "SELECT top 10 class_name,students from class";
$getResults= sqlsrv_query($conn, $tsql);
while ($row = sqlsrv_fetch_array($getResults)) {
 echo nl2br("\n");
 echo ($row['class_name'] . " " . $row['students'] . PHP_EOL);
}
sqlsrv_free_stmt($getResults);
?>