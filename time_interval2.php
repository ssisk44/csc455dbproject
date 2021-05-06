<?php
    include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
        <title>Time Interval</title>
    </head>

<body>
  <?php
       $stmt = "CALL getInterval('2021-04-28 00:00','2021-05-28 22:59', 15, 'MSFT');";
       $result2 = mysqli_query($conn, $stmt);
       $resultCheck2 = mysqli_num_rows($result2);
       if ($resultCheck2 > 0) {
           echo "<table><tr>
                   <th>stockTicker</th>
                   <th>timeIntervalStart</th>
                   <th>timeIntervalEnd</th>
                   <th>priceId</th>
                   <th>startPrice</th>
                   <th>endPrice</th>
                   <th>volumeTraded</th>
                   <th>lowPrice</th>
                   <th>highPrice</th>
                </tr>";
           while ($row = mysqli_fetch_assoc($result2)) {echo "<tr>
                   <td>" . $row['stockTicker'] . "</td>
                   <td>" . $row['timeIntervalStart'] . "</td>
                   <td>" . $row['timeIntervalEnd'] . "</td>
                   <td>" . $row['priceId'] . "</td>
                   <td>" . $row['startPrice'] . "</td>
                   <td>" . $row['endPrice'] . "</td>
                   <td>" . $row['volumeTraded'] . "</td>
                   <td>" . $row['lowPrice'] . "</td>
                   <td>" . $row['highPrice'] . "</td>
                </tr>";
           }
       echo "</table>";
  }
  ?>
</body>
</html>