<?php include 'core/init.php'; ?>
<!DOCTYPE html>
<?php protected_pages(); ?>
<?php
$user_id = $user_data['user_id'];
$query = mysql_query("SELECT `status` FROM `tickets` WHERE `user_id` = '$user_id' ORDER BY `ticket_id` DESC LIMIT 1");
if (mysql_num_rows($query) != 0) {
	if (mysql_result($query, 0) == 1) {
		header("location: tickets.php?login_hash=".$_SESSION['login_hash']."&error=1");
	}
}

if (isset($_POST['submit']) === true) {
	if ($_POST['subject'] != "" AND $_POST['message'] != "") {
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$user_id = $user_data['user_id'];
		$last_update = time();
		create_ticket($subject, $message, $user_id, $last_update);
		header("location: viewticket.php?login_hash=".$_SESSION['login_hash']."&id=".get_latest_ticket()."&success#view");
	}
}
?>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Tickets</title>
<link rel="shortcut icon" href="favicon.gif" />
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<?php include 'includes/widgets/newticket.php'; ?>
</div>
</body>
</html>