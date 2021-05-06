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
	h2{
		border-bottom: 3px solid blue;
		border-top: 3px solid blue;}
</style>
  <body>
    <h2>1. Minimum Price For Each Stock</h2>
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

<h2>2. Maximum Price For MSFT Stock</h2>
<?php
      $sql2 = "SELECT MAX(priceRecord.endPrice), time.stockTicker, stock.companyName
FROM ((priceRecord INNER JOIN time ON priceRecord.priceId = time.priceId) INNER JOIN stock ON time.stockTicker = stock.stockTicker)
GROUP BY time.stockTicker
HAVING time.stockTicker LIKE 'MSFT';";
      $result2 = mysqli_query($conn, $sql2);
      $resultCheck2 = mysqli_num_rows($result2);

      if ($resultCheck2 > 0) {
	echo "<table><tr><th>Maximum Price</th><th>Stock Ticker</th><th>Company Name</th></tr>";
        while ($row = mysqli_fetch_assoc($result2)) {
          echo "<tr><td>" . $row['MAX(priceRecord.endPrice)'] . "</td><td>" . $row['stockTicker']  . "</td><td>" . $row['companyName'] . "</tr>";
      }
	echo "</table>";
}?>
<h2>3. Id Of Most Recent Stock For Each Company</h2>
    <?php
      $sql = "SELECT MIN(priceRecord.priceId), time.stockTicker
FROM (priceRecord INNER JOIN time ON priceRecord.priceId = time.priceId)
GROUP BY time.stockTicker;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
	echo "<table><tr><th>Stock Ticker</th><th>Newest Price ID</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row['stockTicker'] . "</td><td>" . $row['MIN(priceRecord.priceId)']  . "</td></tr>";
      }
	echo "</table>";
}?>
<h2> 4. Most Recent Price ID by Stock </h2>
    <?php
      $sql = "SELECT MIN(priceRecord.priceId), time.stockTicker, stock.companyName FROM ((priceRecord INNER JOIN time ON priceRecord.priceId = time.priceId) INNER JOIN stock ON time.stockTicker = stock.stockTicker) GROUP BY time.stockTicker;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
    echo "<table><tr><th>Most Recent ID</th><th>Stock Ticker</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row['MIN(priceRecord.priceId)'] . "</td><td>" . $row['stockTicker']  . "</tr>";
      }
    echo "</table>";
}?>

<h2>5 & 6. Time interval</h2>
<form action="time_interval_result.php" method="post">
           <label for="startTime">Select the start of an interval Format(YYYY-MM-DD HH:mm:ss):</label>
           <input type="text" id="startTime" name="startTime"><br/>
           <label for="endTime">Select the end of an interval Format(YYYY-MM-DD HH:mm:ss):</label>
           <input type="text" id="endTime" name="endTime"><br/>
           <label for="ticker">Enter the ticker you're looking for  </label>
           <input type="text" id="ticker" name="ticker"><br/>
           <input type="submit">
       </form><h2>7. Above Average Stock Volume Traded</h2>
<form method="post" action="AboveAVGvolumeTraded.php">
   <input type="submit" value="Click Here To Load Query"></form>
<h2>8. Stocks LIKE WildCard Option</h2>
<h3>Please Enter An Approved Stock Ticker</h3>
<form method="post" action="StockSearch.php">
  <input type="text" name="testform">
  <input type="submit"></form>
<p>Approved Tickers include MSFT, AAPL, TSLA, AMZN, and MSFT</p>
<h2>9. Trigger Query</h2>
<p>Enter a priceId, you can choose the most Recent Id from the table above if you do not know any.</p>
<form method="post" action="Trigger.php">
  <input type="text" name="testform2">
  <input type="submit"></form>
<h2>10. Each Stock Start and End Price for Price ID</h2>
    <form method="post" action="startandend.php">
   <input type="submit" value="Click Here To Load Query"></form>

    </body>
</html>