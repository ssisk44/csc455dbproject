<?php
    include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Time Interval</title>
    </head>
    <style>
        table, th{
            border: 2px solid black;}
        td{
            border: 1px solid green;}
    </style>
    <body>
       <form action="time_interval.php" method="post">
           <label for="startTime">Select the start of an interval:</label>
           <input type="datetime-local" id="startTime" name="startTime"><br/>
           <label for="endTime">Select the end of an interval:</label>
           <input type="datetime-local" id="endTime" name="endTime"><br/>
           <label for="interval">Enter the time interval of the records you want (in minutes): </label>
           <input type="number" id="interval" name="interval"><br/>
           <label for="ticker">Enter the ticker you're looking for  </label>
           <input type="text" id="interval" name="interval"><br/>
           <input type="submit">
       </form>
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
