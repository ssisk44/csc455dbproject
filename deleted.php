<?php
  include_once 'includes/dbh.inc.php';
  ?>
<h2>All Deleted Record</h2>
<?php
      $sql = "SELECT * FROM deleted_priceRecord;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
	echo "<table><tr><th>priceId</th><th>Start Price</th><th>End Price</th><th>Volume Traded</th><th>Low Price</th><th>High Price</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row['deleted_priceId'] . "</td><td>" . $row['deleted_startPrice'] . "</td><td>" . $row['deleted_endPrice'] . "</td><td>" . $row['deleted_volumeTraded'] . "</td><td>" . $row['deleted_lowPrice']  . "</td><td>" . $row['deleted_highPrice'] . "</tr>";
      }
	echo "</table>";
}?>
