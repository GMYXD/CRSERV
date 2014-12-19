<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$order_id = $_GET['id'];
	$_SESSION['order_id'] = $order_id;
	$query = mysql_query("SELECT * FROM `orders` WHERE `order_id` = '$order_id'") or die(mysql_error());
		if (mysql_num_rows($query) > 0) {
			$row = mysql_fetch_assoc($query);
			$_SESSION['service_type'] = $row['service_type'];
			$_SESSION['link'] = $row['link'];
			$_SESSION['quantity'] = $row['quantity'];
			$_SESSION['status'] = $row['status'];
			$_SESSION['start_count'] = $row['start_count'];
		} else {
			header("location: orders.php?status=0");
		}
} else {
	header("location: orders.php?status=0");
}

if (isset($_POST['submit']) === true) {
	if (empty($_POST['start_count']) >= 0) {
		$change_status = $_POST['change_status'];
		$start_count = $_POST['start_count'];
		change_order_status($_SESSION['order_id'], $change_status, $start_count);
		header("location: change_status.php?id=".$_SESSION['order_id']."&success");
	} else {
		header("location: change_status.php?id=".$_SESSION['order_id']."&error=1");
	}
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Change Order Status</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:285px;" align="left">
<?php change_order_status_messages(); ?>
<?php include 'includes/widgets/change_status.php'; ?>
</div>
</div>
</body>
</html>