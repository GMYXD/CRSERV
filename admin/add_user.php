<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_POST['submit']) === true) {
	if (empty($_POST['username']) === false) {
		$username = $_POST['username'];
		$username = sanitize($username);
		$password = random_password(10);
		$balance = "0.00";
		$spent = "0.00";
		$permission = "0";
		$ip = "";
		$date = datetime();
		if (user_exists($username) === false) {
			add_user($username, $password, $balance, $spent, $ip, $permission, $date);
			header("location: add_user.php?success");
		} else {
			header("location: add_user.php?error=2");
		}
	} else {
		header("location: add_user.php?error=1");
	}
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add User</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:400px;" align="left">
<?php add_user_messages(); ?>
</div>
<?php include 'includes/widgets/add_user.php'; ?>
</div>
</div>
</body>
</html>