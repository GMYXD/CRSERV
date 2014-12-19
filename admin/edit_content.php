<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
if (isset($_GET['id']) === true AND empty($_GET['id']) === false) {
	$page_id = $_GET['id'];
	$_SESSION['page_id'] = $page_id;
	$query = mysql_query("SELECT `content` FROM `pages` WHERE `page_id` = '$page_id'") or die(mysql_error());
		if (mysql_num_rows($query) > 0) {
			$row = mysql_fetch_assoc($query);
			$_SESSION['content'] = $row['content'];
		} else {
			header("location: content1.php");
		}
} else {
	header("location: content2.php");
}

if (isset($_POST['submit']) === true) {
	$content = $_POST['content'];
	edit_content($_SESSION['page_id'], $content);
	header("location: edit_content.php?id=".$_SESSION['page_id']."&success");
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Edit Content</title>
<link rel="shortcut icon" href="favicon.gif" />
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<div style="width:600px;" align="left">
<?php edit_content_messages(); ?>
</div>
<?php include 'includes/widgets/edit_content.php'; ?>
</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/edit_content.js"></script>
</body>
</html>
