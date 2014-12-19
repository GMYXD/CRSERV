<?php include "core/init.php"; ?>
<?php protected_pages(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Balance</title>
<link rel="shortcut icon" href="favicon.gif" />
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body style="background-color: #f9f9f9;">
<?php include 'includes/nav.php'; ?>
<div class="container-fluid">
<?php include 'includes/widgets/balance.php'; ?>
<?php echo get_content(3); ?>
</div>
</body>
</html>