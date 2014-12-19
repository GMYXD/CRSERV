<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$user_id = $_GET['id'];
	$user_id = (int)$user_id;
	$query1 = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$user_id'") or die(mysql_error());
		if (mysql_num_rows($query1) > 0) {
			$row = mysql_fetch_assoc($query1);
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
		}
}

if (isset($_POST['submit']) === true) {
	$required_fields = array('username', 'password');
	foreach ($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			header("location: ?error=3");
			exit();
		}
	}
		$username = $_POST['username'];
		$password = $_POST['password'];
		$username = sanitize($username);
		$password = sanitize($password);
		$username = trim($username);
		$password = trim($password);
		$user_id = $_GET['id'];
		$user_id = (int)$user_id;
		if ($_SESSION['username'] != $username) {
			if (user_exists($username) === false) {
				mysql_query("UPDATE `users` SET `username` = '$username', `password` = '$password' WHERE `user_id` = '$user_id'") or  die(mysql_error());
				header("location: ?id=".$_GET['id']."&success");
			} else {
				header("location: ?id=".$_GET['id']."&error=1");
			}
		} else {
			mysql_query("UPDATE `users` SET `username` = '$username', `password` = '$password' WHERE `user_id` = '$user_id'") or  die(mysql_error());
			header("location: ?id=".$_GET['id']."&success");
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit user details</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:285px;" align="left">
<?php user_update_messages(); ?>
</div>
<?php include 'includes/widgets/user_update.php'; ?>
</div>
</div>
</body>
</html>