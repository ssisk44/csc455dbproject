<?php
  include_once 'includes/dbh.inc.php';
  ?>
<!DOCTYPE html>
<html>
  <style>
	table, th{
		border: 2px solid black;}
	td{
		border: 1px solid green;}
	h2{
		border-bottom: 3px solid blue;
		border-top: 3px solid blue;}
</style>

<h2>Each Stock Start and End Price for Price ID</h2>
    <?php
      $sql6 = "SELECT T2.priceId, T1.startPrice, T1.endPrice, time.stockTicker FROM priceRecord T1, priceRecord T2, time WHERE T2.priceId = T1.priceId;";
      $result6 = mysqli_query($conn, $sql6);
      $resultCheck6 = mysqli_num_rows($result6);

      if ($resultCheck6 > 0) {
    echo "<table><tr><th>Stock Ticker</th><th>Price ID</th><th>Start Price</th><th>End Price</th></tr>";
        while ($row = mysqli_fetch_assoc($result6)) {
          echo "<tr><td>" . $row['stockTicker'] . "</td><td>" . $row['priceId']  . "</td><td>" . $row['startPrice']  . "</td><td>" . $row['endPrice']  . "</td></tr>";
      }
    echo "</table>";
}?>
</html>