<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_POST['submit']) === true) {
	$required_fields = array('type', 'rate', 'min', 'unit');
	foreach ($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			header("location: add_service.php?error=1");
			exit();
		}
	}
	$type = $_POST['type'];
	$rate = $_POST['rate'];
	$min = $_POST['min'];
	$unit = $_POST['unit'];
	add_service($type, $rate, $min, $unit);
	header("location: add_service.php?success");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add service</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:285px;" align="left">
<?php 
add_service_messages();
include 'includes/widgets/add_service.php'; 
?>
</div>
</div>
</div>
</body>
</html>