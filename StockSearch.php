<?php
  include_once 'includes/dbh.inc.php';
  ?>
<!DOCTYPE html>
<html>
<h2>Minimum Price For Chosen Stock</h2>
    <?php
      $data = $_REQUEST['testform'];
      $sql2 = "SELECT priceRecord.endPrice, time.stockTicker, stock.companyName
FROM ((priceRecord INNER JOIN time ON priceRecord.priceId = time.priceId) INNER JOIN stock ON time.stockTicker = stock.stockTicker)
HAVING time.stockTicker LIKE '$data';";
      $result2 = mysqli_query($conn, $sql2);
      $resultCheck2 = mysqli_num_rows($result2);

      if ($resultCheck2 > 0) {
	echo "<table><tr><th>Maximum Price</th><th>Stock Ticker</th><th>Company Name</th></tr>";
        while ($row = mysqli_fetch_assoc($result2)) {
          echo "<tr><td>" . $row['endPrice'] . "</td><td>" . $row['stockTicker']  . "</td><td>" . $row['companyName'] . "</tr>";
      }
	echo "</table>";
}?>
</body>
</html>
