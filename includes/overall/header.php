<?php include 'core/init.php';?>
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
			<div class="nav-collapse">
				<ul class="nav" id="user_nav">
					<li><a href="/">New Order</a></li>
					<li><a href="/history.php">Orders History</a></li>
					<li><a href="/balance.php">Balance</a></li>
					<li><a href="/faq.php">F.A.Q.</a></li>
				</ul>
				<p class="navbar-text pull-right">You logged as <a href="/settings.php"><b><?php echo $user_data['username']; ?></b></a>
					<a href="/logout.php" class="btn btn-mini" style="margin:-3px 0px 0px 10px;cursor:default;">Logout</a>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
