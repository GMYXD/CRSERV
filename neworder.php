<?php include "core/init.php"; ?>
<?php protected_pages(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>New Order</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<script src="http://getyourpanel.com/themes/themes/default/site/js/jquery-1.8.2.min.js"></script>
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:285px;" align="left">
<?php
echo order_error();
if (isset($_POST['submit']) === true) {
	$current_date = current_date();
	$service_id = $_POST['service'];
	$link = $_POST['link'];
	$quantity = $_POST['quantity'];
	$user_id = $user_data['user_id'];
	$rate = get_service_charges($service_id);
	$start_count = 0;
	$status = 0;
	$type = get_service_name($service_id);
	$remains = $quantity;
	$spent = $user_data['spent'];
	if (filter_var($link, FILTER_VALIDATE_URL)) {
		$query = mysql_query("SELECT * FROM `services` WHERE `service_id` = '$service_id'");
		$row = mysql_fetch_assoc($query);
		$_SESSION['min'] = $row['min'];
		$_SESSION['unit'] = $row['unit'];
		$quantity = (int)$quantity;
		if ($quantity >= $row['min']) {
			order_creading($user_id, $current_date, $link, $rate, $spent, $start_count, $quantity, $type, $status, $remains);
		} else {
			header("location: neworder.php?login_hash=".$_SESSION['login_hash']."&error=2");
		}
	} else {
		header("location: neworder.php?login_hash=".$_SESSION['login_hash']."&error=1");
	}
}
include 'includes/widgets/neworder.php';
?>
</div>
</div>
</body>
</html>