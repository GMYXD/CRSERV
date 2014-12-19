<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include 'database/connect.php';
include 'functions/users.php';
include 'functions/general.php';
include 'functions/messages.php';
if (logged_in() === true) {
	$session_user_id = $_SESSION['admin_user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'balance', 'spent', 'permission', 'registration_date', 'last_login');
		if (admin_permission($user_data['username']) == 0) {
			header("location: http://panel.edu4pak.com/admin/logout.php");
			exit();
		}
	}
?>