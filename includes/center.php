<div align="center">
<?php 
if (logged_in() === true) {
	include 'includes/widgets/neworder.php';
} else {
	include 'includes/widgets/login.php';
}
?>
</div>
