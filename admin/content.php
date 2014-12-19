<?php include 'core/init.php'; ?>
<?php logged_in_permission(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Content</title>
<link rel="shortcut icon" href="favicon.gif" />
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<div align="center">
<?php include 'includes/widgets/content.php'; ?>
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
