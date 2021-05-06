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
</style>
<h2>Above Average Stock Volume Traded</h2>
<?php
  $sql3 = "SELECT priceRecord.volumeTraded, time.stockTicker
FROM (priceRecord INNER JOIN time ON priceRecord.priceId = time.priceId)
WHERE priceRecord.volumeTraded > (SELECT AVG(volumeTraded) FROM priceRecord)";
  $result3 = mysqli_query($conn, $sql3);
  $resultCheck3 = mysqli_num_rows($result3);
  if ($resultCheck3 > 0) {
echo "<table><tr><th>Stock Ticker</th><th>Stock Volume Traded</th></tr>";
    while ($row = mysqli_fetch_assoc($result3)) {
      echo "<tr><td>" . $row['stockTicker'] . "</td><td>" . $row['volumeTraded'] . "</tr>";
  }
echo "</table>";
}?>

</html>
