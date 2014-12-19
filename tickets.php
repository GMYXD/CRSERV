<?php include 'core/init.php'; ?>
<?php protected_pages(); ?>
<?php
$user_id = $user_data['user_id'];
$query1 = mysql_query("SELECT COUNT(`ticket_id`) FROM `tickets` WHERE `user_id` = '$user_id'") or die(mysql_error());
$row = mysql_fetch_row($query1);
$rows = $row['0'];
$page_rows = 10;
$last = ceil($rows/$page_rows);
if ($last < 1) {
	$last = 1;
}

$pagenum = 1;
if (isset($_GET['pn']) === true) {
	$pagenum = $_GET['pn'];
	$pagenum = (int)$pagenum;
}

if ($pagenum < 1) {
	$pagenum = 1;
} else if ($pagenum > $last) {
	$pagenum = $last;
}

$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
$query2 = mysql_query("SELECT * FROM `orders` WHERE `user_id` = '$user_id' ORDER by `order_id` DESC $limit") or die(mysql_error());
$pg_ctr = '';

if ($last != 1) {
	if ($pagenum > 1) {
		$previous = $pagenum - 1;
		$pg_ctr .= '<li class="prev"><a href="'.$_SERVER['PHP_SELF'].'?login_hash='.$_SESSION['login_hash'].'&pn='.$previous.'"><span class="glyphicon glyphicon-step-backward"></span> Prev </a></li>';
		for($i = $pagenum - 4; $i < $pagenum; $i++) {
			if ($i > 0) {
				$pg_ctr .= '<li><a href="'.$_SERVER['PHP_SELF'].'?login_hash='.$_SESSION['login_hash'].'&pn='.$i.'">'.$i.'</a></li>';
			}
		}
	}
	
	$pg_ctr .= '<li class="active"><a>'.$pagenum.'</a></li>';
	for ($i = $pagenum + 1; $i <= $last; $i++) {
		$pg_ctr .= '<li><a href="'.$_SERVER['PHP_SELF'].'?login_hash='.$_SESSION['login_hash'].'&pn='.$i.'">'.$i.'</a></li>';
		if ($i >= $pagenum + 4) {
			break;
		}
	}
	
	if ($pagenum != $last) {
		$next = $pagenum + 1;
		$pg_ctr .= '<li class="next"><a href="'.$_SERVER['PHP_SELF'].'?login_hash='.$_SESSION['login_hash'].'&pn='.$next.'"><span class="glyphicon glyphicon-step-backward"></span> Next </a></li>';
	}
}
?>
<!DOCTYPE html>
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
<?php ticket_message(); ?>
</div>
<?php include 'includes/widgets/tickets.php'; ?>
<div align="center">
<?php 
if ($rows > $page_rows) {
	echo '<ul class="pagination pagination-right">';
	echo $pg_ctr;
	echo '</ul>';
	echo '<p>Page '.$pagenum.' of '.$last.', showing '.$page_rows.' records out of '.$rows.' total.</p>';
}
?>
</div>
</div>
</body>
</html>