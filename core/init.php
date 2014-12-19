<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include 'database/connect.php';
include 'functions/users.php';
include 'functions/general.php';
include 'functions/messages.php';
if (logged_in() === true) {
	login_hash($_GET['login_hash']);
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'balance', 'spent', 'registration_date', 'last_login');
}
?>