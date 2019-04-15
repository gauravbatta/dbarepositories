<?php

/* Include the `fusioncharts.php` file that contains functions	to embed the charts. */

   include("fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "fusioncharts_phpsample";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
?>

<html>
   <head>
  	<title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

  	<!-- You need to include the following JS file to render the chart.
  	When you make your own charts, make sure that the path to this JS file is correct.
  	Else, you will get JavaScript errors. -->

  <script src="fusioncharts.js"></script>
  <script src="fusioncharts.charts.js"></script>
  <script src="fusioncharts.theme.zune.js"></script>
  </head>

   <body>
        	<FORM NAME ="form1" METHOD ="post" ACTION = "">
        	<br>
        	Chart Type :
			<select name="formchart">
			<option value="area2d">area2d</option>
			<option value="bar2d">bar2d</option>
			<option value="bar3d">bar3d</option>
			<option value="column2d">column2d</option>
			<option value="column3d">column3d</option>
			<option value="pie2d">pie2d</option>
			<option value="pie3d">pie3d</option>
			<option value="pareto2d">pareto2d</option>
			<option value="pareto3d">pareto3d</option>
			<option value="line">line</option>
            </select> <br>
        	<br> Chart Caption : <INPUT TYPE = "Text" NAME = "captions" value ="SLA_BenchMarks" > <br>
        	<br> <b> Enter your query for chart </b> <br> <br><textarea name="tarea" rows="3" cols="100"> select yyyymmdd as c1,sla_250ms as v1, sla_1000ms as v2, sla_4000ms as v3 from sla_master_list where region='etdo2-EV6' and yyyymmdd >= ( CURDATE() - INTERVAL 180 DAY ) order by 1 </textarea> <br>
        	<INPUT TYPE = "Submit" Name = "Submit" VALUE = "Go"> <br>


  	<?php

     	// Form the SQL query that returns the top 10 most populous countries


				$strQuery = $_POST["tarea"];
				$captions = $_POST["captions"];
				$charttype = $_POST["formchart"];


     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  //"caption" => $captions,
                  "caption" => "RSA AAH",
                  "subCaption" => "Benchmark SLA for last year",
                  "xAxisname"=> "Dates",
				  "yAxisName"=> "SLA",
                  "legendItemFontColor"=> "#666666",
                  "theme" => "zune"
              	)
           	);

          // creating array for categories object

          $categoryArray=array();
          $dataseries1=array();
          $dataseries2=array();
          $dataseries3=array();

          // pushing category array values
          while($row = mysqli_fetch_array($result)) {
            array_push($categoryArray, array(
            "label" => $row["c1"]
          )
        );
        array_push($dataseries1, array(
          "value" => $row["v1"]
          )
        );

        array_push($dataseries2, array(
          "value" => $row["v2"]
          )
        );
        array_push($dataseries3, array(
          "value" => $row["v3"]
          )
        );

      }

      $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "SLA_250ms", "data"=>$dataseries1), array("seriesName"=> "SLA_1000ms",  "renderAs"=>"line", "data"=>$dataseries2),array("seriesName"=> "SLA_4000ms",  "renderAs"=>"area", "data"=>$dataseries3));
      //$arrData["dataset"] = array(array("seriesName"=> "SLA_250ms", "renderAs"=>"line", "data"=>$dataseries1), array("seriesName"=> "SLA_1000ms",  "renderAs"=>"line", "data"=>$dataseries2),array("seriesName"=> "SLA_4000ms",  "renderAs"=>"line", "data"=>$dataseries3));


      /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
      $jsonEncodedData = json_encode($arrData);

      // chart object
      $msChart = new FusionCharts("mscombi2d", "chart1" , "2000", "350", "chart-container", "json", $jsonEncodedData);

      // Render the chart
      $msChart->render();

      // closing db connection
      $dbhandle->close();

   }

?>

<center>
                <div id="chart-container">Chart will render here!</div>
            </center>
    </body>

    </html>