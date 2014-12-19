<?php include 'core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title><?php 
if (logged_in() === false) {
echo 'iExpert SMM Panel';
} else {
echo 'New Order';
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
<?php 
if (logged_in() === false) {
	include 'includes/widgets/login.php';
	echo get_content(1);
} else {
	header("location: neworder.php");
	//include 'includes/widgets/create_order.php';
	//echo get_content(2);
}
?>
</div>
</body>
</html>