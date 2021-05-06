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
        <?php
            include_once "includes/dbh.inc.php";
            if (isset($_POST["startTime"])) {
                $startDate = $_POST["startTime"];
                $endDate = $_POST["endTime"];
                $ticker = $_POST["ticker"];
                echo "<h2>stocks from $ticker from $startDate to $endDate</h2>";
                $stmt = "CALL getInterval('$startDate', '$endDate', '$ticker');";
                $result1 = mysqli_query($conn, $stmt);
                $resultCheck1 = mysqli_num_rows($result1);
                $stmt2 = "SELECT averageBetween('$startDate', '$endDate', '$ticker');";
                $conn->next_result();
                $result2 = mysqli_query($conn,$stmt2);
                $row2 = $result2->fetch_row();
                if ($resultCheck1 > 0) {
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
                    while ($row = $result1->fetch_row()) {
                        echo "<tr>
                                    <td>" . $row[0] . "</td>
                                    <td>" . $row[1] . "</td>
                                    <td>" . $row[2] . "</td>
                                    <td>" . $row[3] . "</td>
                                    <td>" . $row[4] . "</td>
                                    <td>" . $row[5] . "</td>
                                    <td>" . $row[6] . "</td>
                                    <td>" . $row[7] . "</td>
                                    <td>" . $row[8] . "</td>
                                 </tr>";
                    }
                }
                echo "</table>";
                echo "<h2>The average for this interval: $row2[0]</h2>";
            }
        ?>
<!--
//            $startDate = $_POST["startTime"];
//            $endDate = $_POST["endTime"];
//            $ticker = $_POST["ticker"];
////          $stmt2 = "SELECT averageBetween('$startDate', '$endDate', '$ticker');";
//            $stmt2 = "SELECT averageBetween('2021-04-28 01:00:00', '2021-04-28 05:00:00', 'MSFT');";
//            $result2 = mysqli_query($conn, $stmt2);
//            $row = $result2->fetch_field();
//            echo "<h2>Average for this interval: </h2>" . $row[0];
//        ?>-->
    <a href="index.php">back to main page</a>
    </body>
</html>
