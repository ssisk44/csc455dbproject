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
      $sql = "SELECT * FROM priceRecord;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
	echo "<table><tr><th>PriceId</th><th>LowPrice</th><th>HighPrice</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row['priceId'] . "</td><td>" . $row['lowPrice']  . "</td><td>" . $row['highPrice'] . "</tr>";
      }
	echo "</table>";
}
    ?>
  </body>
</html>
