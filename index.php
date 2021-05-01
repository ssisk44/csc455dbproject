<?php
  include_once 'includes/dbh.inc.php';
  ?>
<!DOCTYPE html>
<html>
  <head>
      <title>Welcome to our CSC455 Final Project</title>
  </head>
  <body>

    <?php
      $sql = "SELECT * FROM priceRecord;";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo $row['priceId'] . $row['lowPrice'] . "<br>";
        }
      }
    ?>
  </body>
</html>
