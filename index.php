<?php
  include_once 'includes/dbh.inc.php';
  ?>
<!DOCTYPE html>
<html>
  <head>
      <title>Welcome to our CSC455 Final Project</title>
  </head>
  <style>
	table, th{
		border: 2px solid black;}
	td{
		border: 1px solid green;}
</style>
  <body>
    <h2>PriceID LowPrice, and HighPrice</h2>
    <?php
      
      $sqlmin = 'SELECT MIN(endPrice) FROM priceRecord;';
      $resultmin = $conn->query($sqlmin);
      
      $sqlmax = "SELECT MAX(endPrice) FROM priceRecord;;";
      $resultmax = $conn->query($sqlmax);
      
      $resultslabelarray = array('Min','Max');
      $resultsarray = array($sqlmax,$sqlmin);
      
      $arrayindex = 0;
      echo "<table><tr><th>Query</th><th>SQLResponse</th></tr>";
      foreach ($resultsarray as &$value) {
        echo "<tr><td>" . $resultslabelarray[$arrayindex] . "</td><td>" . $value . "</tr>";
        $arrayindex += 1;
      
	  echo "</table>";
      }
    ?>
  </body>
</html>