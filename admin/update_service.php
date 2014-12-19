<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$service_id = $_GET['id'];
	$service_id = (int)$service_id;
	$query1 = mysql_query("SELECT * FROM `services` WHERE `service_id` = '$service_id'") or die(mysql_error());
		if (mysql_num_rows($query1) > 0) {
			$row = mysql_fetch_assoc($query1);
			$_SESSION['type'] = $row['type'];
			$_SESSION['rate'] = $row['rate'];
			$_SESSION['min'] = $row['min'];
			$_SESSION['unit'] = $row['unit'];
			$_SESSION['service_id'] = $service_id;
		}
}

if (isset($_POST['submit']) === true) {
	$service_id = $_SESSION['service_id'];
	$required_fields = array('type', 'rate', 'min', 'unit');
	foreach ($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			header("location: ?id=".$service_id."&error=1");
			exit();
		}
	}
	$type = $_POST['type'];
	$rate = $_POST['rate'];
	$min = $_POST['min'];
	$unit = $_POST['unit'];
	update_service($service_id, $type, $rate, $min, $unit);
	header("location: ?id=".$service_id."&success");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit Services</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:285px;" align="left">
<?php 
update_service_messages();
include 'includes/widgets/update_service.php'; 
?>
</div>
</div>
</div>
</body>
</html>