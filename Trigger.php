<?php
  require('includes/dbh.inc.php');
  ?>
<!DOCTYPE html>
<html>
<h2>All stocks for Chosen Company</h2>
    <?php
	$priceId = intval($_REQUEST['testform2']);
	$sql = "DELETE FROM priceRecord WHERE priceId LIKE $priceId";
	if ($conn->query($sql) === TRUE) {
  		echo "Record deleted successfully";
	} else {
  		echo "Error deleting record: " . $conn->error;

}?>
<form method="post" action="deleted.php">
   <input type="submit" value="View All Deleted Items"></form>

</body>
</html>