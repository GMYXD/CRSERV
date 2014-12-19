<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$service_id = $_GET['id'];
	$service_id = (int)$service_id;
	$query1 = mysql_query("SELECT * FROM `services` WHERE `service_id` = '$service_id'") or die(mysql_error());
		if (mysql_num_rows($query1) > 0) {
			$status = $_POST['status'];
			service_status_update($_GET['id']);
			header("location: services.php");
		} else {
			header("location: services.php");
		}
} else {
	header("location: services.php");
}


?>
