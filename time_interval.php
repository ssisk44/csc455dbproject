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
       <form action="time_interval2.php" method="post">
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
    </body>
</html>
