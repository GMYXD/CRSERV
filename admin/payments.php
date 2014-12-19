<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<?php
$query1 = mysql_query("SELECT COUNT(`payment_id`) FROM `payment`") or die(mysql_error());
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
$pg_ctr = '';

if ($last != 1) {
	if ($pagenum > 1) {
		$previous = $pagenum - 1;
		$pg_ctr .= '<li class="prev"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"><span class="glyphicon glyphicon-step-backward"></span> Prev </a></li>';
		for($i = $pagenum - 4; $i < $pagenum; $i++) {
			if ($i > 0) {
				$pg_ctr .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>';
			}
		}
	}
	
	$pg_ctr .= '<li class="active"><a>'.$pagenum.'</a></li>';
	for ($i = $pagenum + 1; $i <= $last; $i++) {
		$pg_ctr .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>';
		if ($i >= $pagenum + 4) {
			break;
		}
	}
	
	if ($pagenum != $last) {
		$next = $pagenum + 1;
		$pg_ctr .= '<li class="next"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"><span class="glyphicon glyphicon-step-backward"></span> Next </a></li>';
	}
}
?>
<?php
if (isset($_POST['submit']) === true) {
	$required_fields = array('username', 'amount', 'detail');
	foreach ($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			header("location: payments.php?error=1");
			exit();
		}
	}
	$username = $_POST['username'];
	$amount = $_POST['amount'];
	$detail = $_POST['detail'];
	if (user_exists($username) === true) {
		if (is_numeric($amount) === true ) {
			user_payment_update($username, $amount, $detail);
			header("location: payments.php?success");
		} else {
			header("location: payments.php?error=3");
		}
	} else {
		header("location: payments.php?error=2");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Payments</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<?php user_payment_messages(); ?>
<div style="clear:both;"></div>
<?php include 'includes/widgets/payment.php'; ?>
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