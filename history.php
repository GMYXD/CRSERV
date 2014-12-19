<?php include "core/init.php"; ?>
<?php protected_pages(); ?>
<?php
$user_id = $user_data['user_id'];
$query1 = mysql_query("SELECT COUNT(`order_id`) FROM `orders` WHERE `user_id` = '$user_id'") or die(mysql_error());
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
		$pg_ctr .= '<li class="prev"><a href="'.$_SERVER['PHP_SELF'].'?login_hash='.$_SESSION['login_hash'].'&pn='.$previous.'">&laquo; Prev </a></li>';
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
		$pg_ctr .= '<li class="next"><a href="'.$_SERVER['PHP_SELF'].'?login_hash='.$_SESSION['login_hash'].'&pn='.$next.'"> Next &raquo;</a></li>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Order History</title>
<link rel="shortcut icon" href="favicon.gif" />
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<table class="table table-striped table-bordered table-condensed">
<tr>
<th width="5%">Id</th>
<th>Date</th>
<th>Link</th>
<th>Charge</th>
<th>Start count</th>
<th>Quantity</th>
<th>Service type</th>
<th>Status</th>
</tr>
<?php 
$user_id = $user_data['user_id'];
orders_history($user_id, $limit);
?>
</table>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">
function hoverHandler(event) {
	switch(event.type) {
		case 'mouseenter':
		$(this)
		// Stop animation where it is
		.stop(true)
		// Start fading up
		.animate({backgroundColor:'#fd8'}, 'fast');
		break;
		
		case 'mouseleave':
		$(this)
		// Jump to end of animation
		.stop(true, true)
		// Start fading down
		.animate({backgroundColor:'transparent'}, 'slow');
		break;
	}
}

	$(function() {
		$('table').delegate('tbody tr', 'hover', hoverHandler);
	});
</script>
</body>
</html>