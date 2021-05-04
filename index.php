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
    <h2>Minimum Price For Each Stock</h2>
    <?php
      $sql = "SELECT MIN(priceRecord.endPrice), time.stockTicker, stock.companyName
FROM ((priceRecord INNER JOIN time ON priceRecord.priceId = time.priceId) INNER JOIN stock ON time.stockTicker = stock.stockTicker)
GROUP BY time.stockTicker;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
	echo "<table><tr><th>Minimum Price</th><th>Stock Ticker</th><th>Company Name</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row['MIN(priceRecord.endPrice)'] . "</td><td>" . $row['stockTicker']  . "</td><td>" . $row['companyName'] . "</tr>";
      }
	echo "</table>";
}?>
<h2>Maximum Price For Each Stock</h2>
<?php
      $sql2 = "SELECT MAX(priceRecord.endPrice), time.stockTicker, stock.companyName
FROM ((priceRecord INNER JOIN time ON priceRecord.priceId = time.priceId) INNER JOIN stock ON time.stockTicker = stock.stockTicker)
GROUP BY time.stockTicker;";
      $result2 = mysqli_query($conn, $sql2);
      $resultCheck2 = mysqli_num_rows($result2);

      if ($resultCheck2 > 0) {
	echo "<table><tr><th>Maximum Price</th><th>Stock Ticker</th><th>Company Name</th></tr>";
        while ($row = mysqli_fetch_assoc($result2)) {
          echo "<tr><td>" . $row['MAX(priceRecord.endPrice)'] . "</td><td>" . $row['stockTicker']  . "</td><td>" . $row['companyName'] . "</tr>";
      }
	echo "</table>";
}

    ?>
  </body>
</html>
