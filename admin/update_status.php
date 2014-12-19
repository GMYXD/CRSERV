<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$ticket_id = $_GET['id'];
	$ticket_id = (int)$ticket_id;
	$query = mysql_query("SELECT * FROM `tickets` WHERE `ticket_id` = '$ticket_id'") or die(mysql_error());
		if (mysql_num_rows($query) > 0) {
			$row = mysql_fetch_assoc($query);
			$status = $row[status];
			if ($status == 1) {
				$status = 2;
			} else if ($status == 2) {
				$status = 1;
			}
			ticket_status_update($_GET['id'], $status);
			header("location: tickets.php");
		} else {
			header("location: tickets.php");
		}
} else {
	header("location: tickets.php");
}


?>
