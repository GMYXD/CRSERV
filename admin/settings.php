<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_POST['submit']) === true) {
	$required_fields = array('current_password', 'new_password', 'new_password_again');
	foreach ($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			header("location: settings.php?error=1");
			exit();
		}
	}
	
	if (empty($_POST['current_password']) === false) {
		if (md5($_POST['current_password']) == $user_data['password']) {
			if ($_POST['new_password'] != $_POST['new_password_again']) {
				header("location: settings.php?error=3");
				exit();
			} else if (strlen($_POST['new_password']) < 6) {
				header("location: settings.php?error=4");
				exit();
			} else {
				change_password($user_data['user_id'], $_POST['new_password']);
				header("location: settings.php?success");
				exit();
			}
		} else {
			header("location: settings.php?error=2");
			exit();
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Settings</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:285px;" align="left">
<?php change_password_message(); ?>
</div>
<?php include 'includes/widgets/change_password.php'; ?>
</div>
</div>
</body>
</html>