<?php
  require('includes/dbh.inc.php');
  ?>
<!DOCTYPE html>
<html>
<h2>All stocks for Chosen Company</h2>
    <?php
	$sql = "SELECT averageBetween('2021-04-28 01:00:00', '2021-04-28 05:00:00', 'MSFT') as x";
	if ($conn->query($sql) === TRUE) {
  		echo "x";
	} else {
  		echo "Error Running Query " . $conn->error;

}?>
</body>
</html>