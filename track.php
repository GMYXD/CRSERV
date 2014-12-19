<?php include "core/init.php"; ?>
<?php protected_pages(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title><?php 
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
$order_id = $_GET['id'];
$order_id = (int)$order_id;
$order_id = sanitize($order_id);
echo "Status of order #$order_id";
}
?>
</title>
<link rel="shortcut icon" href="favicon.gif" />
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<?php
if (isset($_GET['order']) === true AND empty($_GET['order']) === false) {
	$order_id = $_GET['order'];
	$order_id = sanitize($order_id);
	if ($order_id == 'success') {
	echo '
	<div class="guide" align="center">
	<div class="alert alert-success" style="display:block;width:234px;">Hurry! Your order has been created successfully!</div>
	</div>
	';
	}
}
?>
<table class="table table-striped table-bordered table-condensed">
<tr>
<th width="5%">Id</th>
<th>Date</th>
<th>Link</th>
<th>Charge</th>
<th>Start count</th>
<th>Quantity</th>
<th>Service type</th>
<th>Status</th>
</tr>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$order_id = $_GET['id'];
	$order_id = (int)$order_id;
	order_track($order_id);
} else {
	header("location: ./neworder.php?login_hash=".$_SESSION['login_hash']);
}
?>
</table>
<div class="guide" align="center">
<a href="./neworder.php<?php echo "?login_hash=".$_SESSION['login_hash']; ?>">Go Back!</a>
</div>

</div>
</div>
</div>
</div>
</div>
</body>
</html>