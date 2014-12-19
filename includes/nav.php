<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
<div class="container-fluid">
<a class="brand" href="
<?php
if (logged_in() === false) {
	echo "http://panel.edu4pak.com/";
} else {
	echo "neworder.php?login_hash=".$_SESSION['login_hash'];
}
?>
">iExpert SMM Panel</a>
<?php
if (logged_in() === true) {
include 'includes/widgets/logged_nav.php';
}
?>
</div>
</div>
</div>
