<html>
<body>
  <?php
  if (isset($_POST["startTime"])) {
       $startDate = $_POST["startTime"];
       $endDate = $_POST["endTime"];
       $interval = $_POST["interval"];
       $ticker = $_POST["ticker"];
       $stmt = "CALL getInterval(\"$startDate\", \"$endDate\", $interval, \"$ticker\");";
       $result2 = mysqli_query($conn, $stmt);
       $resultCheck2 = mysqli_num_rows($result2);
       if ($resultCheck2 > 0) {
           echo "<table> <tr>
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
           while ($row = $result2->mysqli_fetch_assoc()) {
               echo "<table> <tr>
                   <th>" . $row["stockTicker"] . "</th>
                   <th>" . $row["timeIntervalStart"] . "</th>
                   <th>" . $row["timeIntervalEnd"] . "</th>
                   <th>" . $row["priceId"] . "</th>
                   <th>" . $row["startPrice"] . "</th>
                   <th>" . $row["endPrice"] . "</th>
                   <th>" . $row["volumeTraded"] . "</th>
                   <th>" . $row["lowPrice"] . "</th>
                   <th>" . $row["highPrice"] . "</th>
                </tr>";
           }
       }
       echo "</table>";
  }
  ?>
</body>
</html>
