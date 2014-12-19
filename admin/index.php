<?php include 'core/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>iExpert SMM Panel</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<?php
if (logged_in() === true) {
	include 'includes/widgets/add_user.php';
} else {
	include 'includes/widgets/login.php';
	echo get_content(1);
}
?>
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