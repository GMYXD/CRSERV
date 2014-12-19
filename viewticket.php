<?php include 'core/init.php'; ?>
<!DOCTYPE html>
<?php protected_pages(); ?>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$ticket_id = $_GET['id'];
	$_SESSION['ticket_id'] = $ticket_id;
	$query = mysql_query("SELECT * FROM `tickets` WHERE `ticket_id` = '$ticket_id'") or die(mysql_error());
		if (mysql_num_rows($query) > 0) {
			$row = mysql_fetch_assoc($query);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['subject'] = $row['subject'];
			$_SESSION['last_update'] = $row['last_update'];
		} else {
			header("location: viewticket.php?login_hash=".$_SESSION['login_hash']);
		}
} else {
	header("location: viewticket.php?login_hash=".$_SESSION['login_hash']);
}

if (isset($_POST['submit']) === true) {
	if (empty($_POST['message']) === false) {
		$message = $_POST['message'];
		$ticket_id = $_SESSION['ticket_id'];
		$user_id = $user_data['user_id'];
		$last_update = time();
		ticket_message_submit($message, $ticket_id, $user_id, $last_update);
		header("location: viewticket.php?login_hash=".$_SESSION['login_hash']."&id=".$_SESSION['ticket_id']."#view");
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
<div align="center">
<?php ticket_created_message() ?> 
</div>
<?php include 'includes/widgets/viewticket.php'; ?>
</div>
</body>
</html>