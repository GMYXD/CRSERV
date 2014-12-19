<?php include 'core/init.php';
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>iExpert SMM Panel</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
<div class="container-fluid">
<a class="brand" href="http://suda-tech.com/core">iExpert SMM Panel</a>
</div>
</div>
</div>
<div class="container-fluid">
<div align="center">
<?php
echo login_errors();
if (isset($_POST['submit']) === true) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = sanitize($username);
	$password = sanitize($password);
	if (empty($_POST['username']) OR empty($_POST['password']) === true) {
		header("location: login.php?error=1");
	} else if (user_exists($username) === false) {
		header("location: login.php?error=1");
	} else {
			if (admin_permission($username) == 1) {
				$login = login($username, $password);
				if ($login === false) {
					header("location: login.php?error=1");
				} else {
					$_SESSION['admin_user_id'] = $login;
					header("location: http://".$_SERVER['HTTP_HOST']."/core/admin/");
				}
			} else {
				header("location: login.php?error=1");
			}
	}
}
include 'includes/widgets/login.php';
?>
</div>
</div>
</body>
</html>